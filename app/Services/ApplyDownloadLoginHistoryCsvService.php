<?php

namespace App\Services;

use App\Models\LoginHistory;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ApplyDownloadLoginHistoryCsvService
{
    private $file_name;
    private $stream;
    private $header = [
        'id',
        'ユーザー名',
        '使用機種',
        'IPアドレス',
        'ログイン日時'
    ];

    public function __construct(Carbon $carbon)
    {
        $this->file_name = $carbon->now()->format('YmdHi') . '_laravel_login_history.csv';
        $this->stream    = fopen('php://output', 'w');
    }

    // データを取得してCSV出力
    public function downloadCsv(Request $request, LoginHistory $login_history)
    {
        return $this->settingCsv($login_history->acquisitionFormCsvList($request));
    }

    // データを元にCSVデータを整形
    private function settingCsv(array $login_historys)
    {
        return response()->streamDownload(
            function () use ($login_historys) {
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
                foreach ($login_historys as $login_history) {
                    fputcsv($this->stream, $this->processingCsvData($login_history));
                }
                fclose($this->stream);
            },
            $this->file_name,
            ['Content-Type' => 'application/octet-stream']
        );
    }

    // CSV出力するデータを加工
    private function processingCsvData(LoginHistory $login_history): array
    {

        $attribute = [
            $login_history->id,
            $login_history->admin->name,
            $login_history->user_agent,
            $login_history->ip_adress,
            '="' . $login_history->login_time . '"',
        ];
        return $attribute;
    }
}
