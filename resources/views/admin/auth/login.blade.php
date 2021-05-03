@extends('layouts.admin.guest.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">ログイン</div>

                <div class="card-body bg-white-grey py-5">
                    <form method="POST" action="{{ route('admin.login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="login_id" class="col-md-4 col-form-label text-md-right">ID</label>

                            <div class="col-md-6">
                                <input id="login_id" type="text" class="form-control @error('login_id') is-invalid @enderror" name="login_id" value="{{ old('login_id') }}" required autofocus>

                                @error('login_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">パスワード</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-5 mb-0">
                            <div class="col-lg-6 offset-lg-3 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-block shadow-sm mb-4">
                                    ログイン
                                    <i class="fal fa-unlock-alt ml-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
