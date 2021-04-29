@extends('layouts.app')

@section('content')

<div id="wrapper">
    <section id="form_area">
        <div class="inner">
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

                    <dl>
                        <dt><label>性別<span>＊</span></label></dt>
                        <dd>{{ Config::get('const.GENDER')[$request['gender']] }}</dd>
                    </dl>

                    <dl>
                        <dt><label>年齢<span>＊</span></label></dt>
                        <dd>{{ Config::get('const.AGE')[$request['age']] }}</dd>
                    </dl>

                    <dl>
                        <dt><label>郵便番号<span>＊</span></label></dt>
                        <dd>{{ $request['zip'] }}</dd>
                    </dl>

                    <dl>
                        <dt><label>都道府県<span>＊</span></label></dt>
                        <dd>{{ $request['prefecture'] }}</dd>
                    </dl>

                    <dl>
                        <dt><label>市区町村<span>＊</span></label></dt>
                        <dd>{{ $request['city'] }}</dd>
                    </dl>

                    <dl>
                        <dt><label>Eメール<span>＊</span></label></dt>
                        <dd>{{ $request['email'] }}</dd>
                    </dl>

                    <div>
                        <button type="submit" name="button" id="back" value="back">前画面に戻る</button>
                        <button id="loading_back" disabled>前画面に戻る</button>
                        <button type="submit" name="button" id="submit" value="send">送信</button>
                        <button id="loading" disabled>送信中</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
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
