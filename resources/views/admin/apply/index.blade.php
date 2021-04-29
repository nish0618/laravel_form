@extends('layouts.admin.auth.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="content-header">
                <div class="container-fluid">
                    <h1>応募リスト</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pt-4 pb-0 border-0">
                    <form action="" method="get" class="pb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-1">
                                        <input type="text" name="id" class="form-control form-control-sm" placeholder="id" value="{{ Request::input("id") }}">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="email" class="form-control form-control-sm" placeholder="メールアドレス" value="{{ Request::input("email") }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="d-flex justify-content-center">
                                    <div class="mx-2">
                                        <button type="submit" name="button" class="btn btn-sm btn-info" value="search">
                                            検索
                                        </button>
                                    </div>

                                    <div class="mx-2">
                                        <button type="submit" name="button" class="btn btn-sm btn-success" value="csv">
                                            CSV
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th class="border-0 text-center"><small class="text-muted">id</small></th>
                                <th class="border-0 text-center"><small class="text-muted">メールアドレス</small></th>
                                <th class="border-0 text-center"><small class="text-muted">クーポン使用フラグ</small></th>
                                <th class="border-0 text-center"><small class="text-muted">応募日時</small></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($forms->isNotEmpty())
                                @foreach ($forms as $form)
                                    <tr>
                                        <td class="align-middle text-center"><small><a href="{{ route('admin.apply.show', $form->id) }}">{{ $form->id }}</a></small></td>
                                        <td class="align-middle text-center"><small>{{ $form->email }}</small></td>
                                        <td class="align-middle text-center"><small>{{ Config::get('const.COUPON_FLAG')[$form->coupon_flag] }}</small></td>
                                        <td class="align-middle text-center"><small>{{ $form->created_at->format('Y-m-d H:i') }}</small></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <div class="d-flex justify-content-center">
                        @if ($forms->isNotEmpty())
                            {{ $forms->appends(request()->input())->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
