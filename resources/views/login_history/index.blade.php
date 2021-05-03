@extends('layouts.admin.auth.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="content-header">
                <div class="container-fluid">
                    <h1>管理画面ログイン履歴</h1>
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
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end">
                                    <div class="mx-12">
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
                                <th class="border-0 text-center"><small class="text-muted">ユーザー名</small></th>
                                <th class="border-0 text-center"><small class="text-muted">使用機種</small></th>
                                <th class="border-0 text-center"><small class="text-muted">IPアドレス</small></th>
                                <th class="border-0 text-center"><small class="text-muted">ログイン日時</small></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($login_historys->isNotEmpty())
                            @foreach ($login_historys as $login_history)
                            <tr>
                                <td class="align-middle text-center"><small>{{ $login_history->id }}</small></td>
                                <td class="align-middle text-center"><small>{{ $login_history->admin->name }}</small></td>
                                <td class="align-middle text-center"><small>{{ $login_history->user_agent }}</small></td>
                                <td class="align-middle text-center"><small>{{ $login_history->ip_adress }}</small></td>
                                <td class="align-middle text-center"><small>{{ $login_history->login_time }}</small></td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <div class="d-flex justify-content-center">
                        @if ($login_historys->isNotEmpty())
                        {{ $login_historys->appends(request()->input())->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
