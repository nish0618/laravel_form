<?php

namespace App\Http\Controllers;

use App\Models\Deadline;
use App\Models\Form;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    private $form;

    public function __construct(Form $form)
    {
        $this->form = $form;
    }

    public function index(String $unique_url)
    {
        // ユニークURL情報が見つからなければエラー画面にリダイレクト
        if (!$this->form->urlInformation($unique_url)) {
            return redirect()->route('error.index');
        }

        // 現在日時がクーポン引き換え開始時間より前ならクーポン引き換え前の画面にリダイレクト
        if (Carbon::now()->lt(config('const.START_GIFT_REDEMPTION'))) {
            return view('error.gift_redemption_before');
        }

        $end_gift_redemption = Deadline::select('end_gift_redemption')->value('end_gift_redemption');

        // 現在日時が終了期間より大きいなら終了画面にリダイレクト
        if (Carbon::now()->gt($end_gift_redemption)) {
            return redirect()->route('error.gift_redemption_end');
        }

        // クーポン使用フラグのチェック
        $result = $this->form->couponFlagInformation($unique_url);

        return view('coupon.index', [
            'unique_url'  => $unique_url,
            'coupon_flag' => $result['coupon_flag'],
        ]);
    }

    public function apply(Request $request)
    {
        $unique_url = $request->input('unique_url');
        try {
            DB::transaction(function () use ($unique_url) {
                $this->form->updateCouponFlag($unique_url);
            });
        } catch (\Exception $e) {
            return ['message' => $e->getMessage()];
        }
        // 二重送信対策
        $request->session()->regenerateToken();

        return ['status' => 200];
    }

    public function applied(Request $request)
    {
        $unique_url = $request->input('unique_url');
        // クーポン使用フラグのチェック
        $result = $this->form->couponFlagInformation($unique_url);

        return $result;
    }
}
