<?php

namespace App\Models;

use App\Http\Requests\StoreFormRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Form extends Model
{
    protected $fillable = [
        'zip',
        'prefecture',
        'city',
        'email',
        'age',
        'gender',
        'unique_url',
        'coupon_flag',
        'user_agent',
        'ip_adress',
        'post',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // フォーム入力内容を保存
    public function storeForm(StoreFormRequest $request)
    {
        return $this->create(array_merge(
            $request->all(),
            $this->processingFormDate($request)
        ));
    }

    // データを加工
    private function processingFormDate($request): array
    {
        return [
            'post' => serialize($request->all()),
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
            if ($key === 'email') {
                $val !== null ? $query->where($key, 'LIKE', '%' . $val . '%') : '';
            } else {
                $val !== null ? $query->where($key, $val) : '';
            }
        }
        return $query;
    }

    // 検索条件を含めたページャーを生成
    public function acquisitionFormList(Request $request)
    {
        return $this->searchConditionQuery($request)->where('deleted_at', NULL)->orderBy('id', 'ASC')->paginate(25);
    }

    // CSVの検索条件を含めたデータを取得
    public function acquisitionFormCsvList(Request $request)
    {
        return $this->searchConditionQuery($request)->where('deleted_at', NULL)->orderBy('id', 'ASC')->get()->all();
    }

    // 応募フォームの詳細情報を取得
    public function acquisitionApplyInfomation(Int $id)
    {
        return $this->where('id', $id)->first();
    }

    // ユニークURLのアクセスが正しいかチェック
    public function urlInformation(String $unique_url)
    {
        return $this->where('unique_url', $unique_url)->where('deleted_at', NULL)->exists();
    }

    // クーポン使用フラグのチェック
    public function couponFlagInformation(String $unique_url)
    {
        return $this->select(['coupon_flag'])->where('unique_url', $unique_url)->where('deleted_at', NULL)->first();
    }

    // クーポン使用フラグの更新
    public function updateCouponFlag(String $unique_url)
    {
        return $this->where('unique_url', $unique_url)->update(['coupon_flag' => 1]);
    }
}
