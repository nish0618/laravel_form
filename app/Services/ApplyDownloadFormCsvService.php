<?php

namespace App\Services;

use App\Models\Form;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ApplyDownloadFormCsvService
{
    private $file_name;
    private $stream;
    private $header = [
        'id',
        '郵便番号',
        '都道府県',
        '市区町村',
        'メールアドレス',
        '年齢',
        '性別',
        'アンケート１',
        'ユニークURL',
        'クーポン使用フラグ',
        '応募フォーム応募日時'
    ];

    public function __construct(Carbon $carbon)
    {
        $this->file_name = $carbon->now()->format('YmdHi') . '_laravel_form.csv';
        $this->stream    = fopen('php://output', 'w');
    }

    // データを取得してCSV出力
    public function downloadCsv(Request $request, Form $form)
    {
        return $this->settingCsv($form->acquisitionFormCsvList($request));
    }

    // データを元にCSVデータを整形
    private function settingCsv(array $forms)
    {
        return response()->streamDownload(
            function () use ($forms) {
                // 文字コードはUTF-8のまま
                if ($this->stream === FALSE) {
                    throw new Exception('ファイルの書き込みに失敗しました。');
                } else {
                    // BOM をつける
                    fwrite($this->stream, pack('C*', 0xEF, 0xBB, 0xBF));
                }
                // ヘッダー
                fputcsv($this->stream, $this->header);
                // データ
                foreach ($forms as $form) {
                    fputcsv($this->stream, $this->processingCsvData($form));
                }
                fclose($this->stream);
            },
            $this->file_name,
            ['Content-Type' => 'application/octet-stream']
        );
    }

    // CSV出力するデータを加工
    private function processingCsvData(Form $form): array
    {
        $answer_1 = [];
        foreach ($form->questionnaires->where('key', '1') as $questionnaire) {
            array_push($answer_1, config('const.ANSWER_Q1.' . $questionnaire->value));
        }
        $answer_1 = implode(',', $answer_1);

        $attribute = [
            $form->id,
            substr_replace($form->zip, '-', 3, 0),
            $form->prefecture,
            $form->city,
            $form->email,
            config('const.AGE.' . $form->age),
            config('const.GENDER.' . $form->gender),
            empty($answer_1) ? '未回答' : $answer_1,
            env('APP_URL') . '/redeem/' . $form->unique_url,
            config('const.COUPON_FLAG.' . $form->coupon_flag),
            '="' . $form->created_at->format('Y-m-d H:i') . '"'
        ];
        return $attribute;
    }
}
