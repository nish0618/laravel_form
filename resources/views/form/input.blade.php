@extends('layouts.app')

@section('content')

    <form action="{{ route('form.confirm') }}" method="post">
        @csrf
        <input type="hidden" name="user_agent" value="{{ $_SERVER['HTTP_USER_AGENT'] }}">
        <input type="hidden" name="ip_adress" value="{{ $_SERVER['REMOTE_ADDR'] }}">
        <input type="hidden" name="unique_url" value="{{ $unique_url }}">

        @error('unique_url')
            <p class="error">{{ $message }}</p>
        @enderror

        <div>
            <p><span>＊</span>印は入力必須項目です。</p>

            <dl>
                <dt><label>性別<span>＊</span></label></dt>
                <dd>
                    @foreach (Config::get('const.GENDER') as $key => $val)
                    <input id="gender_{{ $key }}" type="radio" name="gender" value="{{ $key }}" {{ $key === (int)old('gender') ? 'checked' : '' }}>
                        <label for="gender_{{ $key }}">{{ $val }}</label>
                    @endforeach
                    @error('gender')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </dd>
            </dl>

            <dl>
                <dt><label>年齢<span>＊</span></label></dt>
                <dd>
                    <div>
                        <select name="age">
                            <option value="" selected>選択してください</option>
                            @foreach (Config::get('const.AGE') as $key => $val)
                                <option name="age" value="{{ $key }}" {{ $key === (int)old('age') ? 'selected' : '' }}>{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('age')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </dd>
            </dl>

            <dl>
                <dt><label>郵便番号<span>＊</span></label></dt>
                <dd>
                    <span>〒</span><input type="text" name="zip" onKeyUp="AjaxZip3.zip2addr('zip', '', 'prefecture', 'city');" placeholder="0000000" value="{{ old('zip') }}">
                    <p>郵便番号を入力いただきますと都道府県・市区町村の項目が自動入力されます。<br>
                        ハイフンなしで入力してください。<br>
                        半角数字で入力してください。</p>
                    @error('zip')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </dd>
            </dl>

            <dl>
                <dt><label>都道府県<span>＊</span></label></dt>
                <dd>
                    <div>
                        <select name="prefecture">
                            <option value="" selected>選択してください</option>
                            @foreach (Config::get('const.PREFECTURE') as $val)
                                <option name="prefecture" value="{{ $val }}" {{ $val === old('prefecture') ? 'selected' : '' }}>{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('prefecture')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </dd>
            </dl>

            <dl>
                <dt><label>市区町村<span>＊</span></label></dt>
                <dd>
                    <input type="text" name="city" value="{{ old('city') }}">
                    @error('city')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </dd>
            </dl>

            <dl>
                <dt><label>Eメール<span>＊</span></label></dt>
                <dd>
                    <input type="email" name="email" value="{{ old('email') }}">
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </dd>
            </dl>

            <dl>
                <dt><label>Eメール(確認用)<span>＊</span></label></dt>
                <dd>
                    <input type="email" name="email_confirmation" value="{{ old('email_confirmation') }}">
                    @error('email_confirmation')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </dd>
            </dl>

            <div>
                同意頂ける方は、下のチェックボックスを入れてください。</p>
                <div><label for="agree"><input type="checkbox" name="agree" id="agree">同意する<span>＊</span></label></div>
            </div>
            <div>
                <button type="submit" id="submit">確認画面へ</button>
                <button id="loading" disabled>確認画面へ</button>
            </div>
        </div>
    </form>

    <script>
    //同意にチェックすると応募ボタン有効化
    $(function() {
        $('#submit').attr('disabled', 'disabled');
        $('#agree').click(function() {
            btnDisabled();
        });

        //送信ボタンを押した際に送信ボタンを無効化する（連打による多数送信回避）
        $('#submit').click(function(){
            $(this).hide();
            $('#loading').show();
        });

        function btnDisabled()
        {
            if ( $('#agree').prop('checked') == false ) {
                $('#submit').attr('disabled', 'disabled');
            } else {
                $('#submit').removeAttr('disabled');
            }
        }
    });
    </script>
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
@endsection
