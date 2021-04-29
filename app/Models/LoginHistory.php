<?php

namespace App\Models;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class LoginHistory extends Model
{
    protected $fillable = [
        'admin_id',
        'user_agent',
        'ip_adress',
        'login_time'
    ];
    
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    // フォーム入力内容を保存
    public function storeForm(String $login_id)
    {
        return $this->create(array_merge(
            $this->processingLoginDate($login_id)
        ));
    }

    // データを加工
    private function processingLoginDate(String $login_id) : Array
    {
        return [
            'admin_id'   => Admin::select('id')->where('login_id', $login_id)->value('id'),
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'ip_adress'  => $_SERVER['REMOTE_ADDR'],            
            'login_time' => Carbon::now(),
        ];
    }

    // 検索条件があれば検索条件を加えたクエリーを生成
    private function searchConditionQuery(Request $request)
    {
        $query = $this->query();
        
        foreach ($request->all() as $key => $val) {
            // pageとbuttonはスキップ
            if ($key === 'page' || $key === 'button') {
                continue;
            }
            $val !== null ? $query->where($key, $val) : '';
        }
        return $query;
    }

    // 検索条件を含めたページャーを生成
    public function acquisitionFormList(Request $request)
    {
        return $this->searchConditionQuery($request)->orderBy('id', 'ASC')->paginate(25);
    }

    // CSVの検索条件を含めたデータを取得
    public function acquisitionFormCsvList(Request $request)
    {
        return $this->searchConditionQuery($request)->orderBy('id', 'ASC')->get()->all();
    }
}
