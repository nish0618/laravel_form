<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ContactMail;
use App\Models\Deadline;
use App\Models\Form;
use Carbon\Carbon;
use DB;
use Log;
use Session;

class FormController extends Controller
{
    public function input()
    {
        // 現在日時がフォーム入力開始時間より前ならエラー画面にリダイレクト
        if (Carbon::now()->lt(config('const.START_FORM'))) {
            return view('error.index');
        }

        $end_publication_period = Deadline::select('end_publication_period')->value('end_publication_period');

        // 現在日時が終了期間より大きいなら終了画面にリダイレクト
        if (Carbon::now()->gt($end_publication_period)) {
            return redirect()->route('error.apply_end');
        }

        // ユニークURLのランダム文字列生成
        $unique_url = Str::random(30);

        return view('form.input', [
            'unique_url' => $unique_url,
        ]);
    }

    public function confirm(StoreFormRequest $request)
    {
        // 不正なアクセスであればエラー画面にリダイレクト
        if (!$request) {
            return redirect()->route('error.index');
        }

        return view('form.confirm', [
            'request' => $request->all(),
        ]);
    }

    public function complete(StoreFormRequest $request, Form $form)
    {
        // 戻るボタン押した時に入力画面へリダイレクト
        if ($request->input('button') === 'back') {
            return redirect()->route('form.input')->withInput();
        }

        $results = DB::transaction(function () use ($request, $form) {
            // フォーム内容を保存
            $form_data = $form->storeForm($request);
            return [
                $form_data,
            ];
        });
        try {
            if (!$results) {
                throw new \Exception('入力情報の保存に失敗しました');
            }
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error', $e->getMessage());
            return redirect()->route('form.input');
        }

        $contact = $request->all();
        Mail::to($contact['email'])->send(new ContactMail($contact));
        // メール送信失敗時、logを残す
        if (count(Mail::failures()) > 0) {
            Log::channel('daily')->warning(Mail::failures());
        };

        // 二重送信対策
        $request->session()->regenerateToken();

        return view('form.complete', [
            'email' => $request->input('email'),
        ]);
    }
}
