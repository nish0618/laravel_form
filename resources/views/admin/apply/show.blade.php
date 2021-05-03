@extends('layouts.admin.auth.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="content-header">
                <div class="container-fluid">
                    <h1>応募者リスト</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-5">
                    @if (!empty($form))
                        <table class="table">
                            <tr>
                                <th class="border-0 w-25"><small class="text-muted">応募日時</small></th>
                                <td class="border-0">{{ $form->created_at->format('Y-m-d H:i') }}</td>
                            </tr>
                            <tr>
                                <th class="border-0 w-25"><small class="text-muted">id</small></th>
                                <td class="border-0">{{ $form->id }}</td>
                            </tr>
                            <tr>
                                <th class="border-0 w-25"><small class="text-muted">郵便番号</small></th>
                                <td class="border-0">{{ $form->zip }}</td>
                            </tr>
                            <tr>
                                <th class="border-0 w-25"><small class="text-muted">都道府県</small></th>
                                <td class="border-0">{{ $form->prefecture }}</td>
                            </tr>
                            <tr>
                                <th class="border-0 w-25"><small class="text-muted">市区町村</small></th>
                                <td class="border-0">{{ $form->city }}</td>
                            </tr>
                            <tr>
                                <th class="border-0 w-25"><small class="text-muted">メールアドレス</small></th>
                                <td class="border-0">{{ $form->email }}</td>
                            </tr>
                            <tr>
                                <th class="border-0 w-25"><small class="text-muted">年齢</small></th>
                                <td class="border-0">{{ Config::get('const.AGE')[$form->age] }}</td>
                            </tr>
                            <tr>
                                <th class="border-0 w-25"><small class="text-muted">性別</small></th>
                                <td class="border-0">{{ Config::get('const.GENDER')[$form->gender] }}</td>
                            </tr>
                            <tr>
                                <th class="border-0 w-25"><small class="text-muted">ユニークURL</small></th>
                                <td class="border-0">{{ env('APP_URL') }}/redeem/{{ $form->unique_url }}</td>
                            </tr>
                            <tr>
                                <th class="border-0 w-25"><small class="text-muted">クーポン使用フラグ</small></th>
                                <td class="border-0">{{ Config::get('const.COUPON_FLAG')[$form->coupon_flag] }}</td>
                            </tr>
                        </table>
                        <a class="btn btn-primary" href="{{ route('admin.apply.index') }}">戻る</a>
                    @else
                        <h5>情報の取得に失敗しました</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
