<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Deadline extends Model
{
    protected $dates = [
        'end_publication_period',
        'end_gift_redemption',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // 検索条件があれば検索条件を加えたクエリーを生成
    private function searchConditionQuery(Request $request)
    {
        $query = $this->query();
        
        foreach ($request->all() as $key => $val) {
            $val !== null ? $query->where($key, $val) : '';
        }
        return $query;
    }

    // 検索条件を含めたページャーを生成
    public function acquisitionDeadlineList(Request $request)
    {
        return $this->searchConditionQuery($request)->orderBy('id', 'ASC')->paginate(25);
    }

    // 応募フォームの詳細情報を取得
    public function acquisitionDeadlineInformation(Int $id)
    {
        return $this->where('id', $id)->first();
    }
}
