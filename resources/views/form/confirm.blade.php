@extends('layouts.app')

@section('content')

<div id="wrapper">
        <div class="container mt-5">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">入力</li>
                    <li class="breadcrumb-item active" aria-current="page">確認</li>
                    <li class="breadcrumb-item">完了</li>
                </ol>
            </nav>

            <form action="{{ route('form.thanks') }}" method="post">
                @csrf
                <input type="hidden" name="user_agent" value="{{ $_SERVER['HTTP_USER_AGENT'] }}">
                <input type="hidden" name="ip_adress" value="{{ $_SERVER['REMOTE_ADDR'] }}">
                <input type="hidden" name="unique_url" value="{{ $request['unique_url'] }}">
                <input type="hidden" name="gender" value="{{ $request['gender'] }}">
                <input type="hidden" name="age" value="{{ $request['age'] }}">
                <input type="hidden" name="zip" value="{{ $request['zip'] }}">
                <input type="hidden" name="prefecture" value="{{ $request['prefecture'] }}">
                <input type="hidden" name="city" value="{{ $request['city'] }}">
                <input type="hidden" name="email" value="{{ $request['email'] }}">
                <input type="hidden" name="email_confirmation" value="{{ $request['email_confirmation'] }}">

                <div>
                    <p>入力内容にお間違えがなければ送信ボタンを押してください。</p>

                    <div>
                        <p>性別</p>
                        <dd>{{ Config::get('const.GENDER')[$request['gender']] }}</dd>
                    </dl>

                    <div>
                        <p>年齢</p>
                        <dd>{{ Config::get('const.AGE')[$request['age']] }}</dd>
                    </dl>

                    <div>
                        <p>郵便番号</p>
                        <dd>{{ $request['zip'] }}</dd>
                    </dl>

                    <div>
                        <p>都道府県</p>
                        <dd>{{ $request['prefecture'] }}</dd>
                    </dl>

                    <div>
                        <p>市区町村</p>
                        <dd>{{ $request['city'] }}</dd>
                    </dl>

                    <div>
                        <p>Eメール</p>
                        <dd>{{ $request['email'] }}</dd>
                    </dl>

                    <div>
                        <button type="submit" name="button" id="back" value="back" class="btn btn-secondary mt-4">前画面に戻る</button>
                        <button id="loading_back" class="btn btn-dark mt-4"disabled>前画面に戻る</button>
                        <button type="submit" name="button" id="submit" value="send" class="btn btn-primary mt-4">送信</button>
                        <button id="loading" class="btn btn-dark mt-4" disabled>送信中</button>
                    </div>
                </div>
            </form>
        </div>
</div>

<script>
$(function() {
    //送信ボタンを押した際に送信ボタンを無効化する（連打による多数送信回避）
    $('#submit').click(function(){
        $(this).hide();
        $('#loading').show();
    });

    $('#back').click(function(){
        $(this).hide();
        $('#loading_back').show();
    });
});

</script>

@endsection
