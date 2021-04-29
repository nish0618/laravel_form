<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\LoginHistory;
use App\Services\ApplyDownloadLoginHistoryCsvService as LoginHistoryCsv;
use Illuminate\Http\Request;

class LoginHistoryController extends Controller
{
    private $login_history;

    public function __construct(LoginHistory $login_history)
    {
        $this->middleware('auth:admin');
        $this->login_history = $login_history;
    }

    public function index(Request $request, LoginHistoryCsv $csv)
    {
        // buttonがcsvの時はCSVを出力
        if ($request->input('button') === 'csv') {
            return $csv->downloadCsv($request, $this->login_history);
        }

        return view('login_history.index', [
            'login_historys' => $this->login_history->acquisitionFormList($request),
        ]);
    }
}
