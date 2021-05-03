@extends('layouts.app')

@section('content')

<form action="{{ route('form.confirm') }}" method="post">
    @csrf
    <input type="hidden" name="unique_url" value="{{ $unique_url }}">

    @error('unique_url')
    <p class="alert alert-danger mt-2">{{ $message }}</p>
    @enderror

    <div class="container mt-5">
        <h1 class="display-4">Laravelフォーム</h1>

        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">入力</li>
                <li class="breadcrumb-item">確認</li>
                <li class="breadcrumb-item">完了</li>
            </ol>
        </nav>
        <p><span class="badge bg-danger">必須</span>は入力必須項目です。</p>

        <div class="mt-4 mb-0 row">
            <div class="col-md-2">性別<span class="badge bg-danger ms-2">必須</span></div>
            <div class="col-sm-10">
                @foreach (Config::get('const.GENDER') as $key => $val)
                <div class="form-check form-check-inline">
                    <input id="gender_{{ $key }}" type="radio" name="gender" class="form-check-input" value="{{ $key }}" {{ $key === (int)old('gender') ? 'checked' : '' }}>
                    <label class="form-check-label" for="gender_{{ $key }}">{{ $val }}</label>
                </div>
                @endforeach
                @error('gender')
                <p class="alert alert-danger mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-4 mb-0 row">
            <div class="col-md-2">年齢<span class="badge bg-danger ms-2">必須</span></div>
            <div class="col-sm-10">
                <select name="age" class="form-select">
                    <option value="" selected>選択してください</option>
                    @foreach (Config::get('const.AGE') as $key => $val)
                    <option name="age" value="{{ $key }}" {{ $key === (int)old('age') ? 'selected' : '' }}>{{ $val }}</option>
                    @endforeach
                </select>
                @error('age')
                <p class="alert alert-danger mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-4 mb-0 row">
            <div class="col-md-2">郵便番号<span class="badge bg-danger ms-2">必須</span></div>
            <div class="col-sm-10">
                <input type="text" name="zip" onKeyUp="AjaxZip3.zip2addr('zip', '', 'prefecture', 'city');" class="form-control form-control-inline" placeholder="0000000" value="{{ old('zip') }}">
                <p>郵便番号を入力いただきますと都道府県・市区町村の項目が自動入力されます。<br>
                    ハイフンなしで入力してください。<br>
                    半角数字で入力してください。</p>
                @error('zip')
                <p class="alert alert-danger mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-4 mb-0 row">
            <div class="col-md-2">都道府県<span class="badge bg-danger ms-2">必須</span></div>
            <div class="col-sm-10">
                <select name="prefecture" class="form-select">
                    <option value="" selected>選択してください</option>
                    @foreach (Config::get('const.PREFECTURE') as $val)
                    <option name="prefecture" value="{{ $val }}" {{ $val === old('prefecture') ? 'selected' : '' }}>{{ $val }}</option>
                    @endforeach
                </select>
                @error('prefecture')
                <p class="alert alert-danger mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-4 mb-0 row">
            <div class="col-md-2">市区町村<span class="badge bg-danger ms-2">必須</span></div>
            <div class="col-sm-10">
                <input type="text" name="city" class="form-control" value="{{ old('city') }}">
                @error('city')
                <p class="alert alert-danger mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-4 mb-0 row">
            <div class="col-md-2">Eメール<span class="badge bg-danger ms-2">必須</span></div>
            <div class="col-sm-10">
                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                @error('email')
                <p class="alert alert-danger mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-4 mb-0 row">
            <div class="col-md-2">Eメール(確認用)<span class="badge bg-danger ms-2">必須</span></div>
            <div class="col-sm-10">
                <input type="email" name="email_confirmation" class="form-control" value="{{ old('email_confirmation') }}">
                @error('email_confirmation')
                <p class="alert alert-danger mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-4 mb-0">
            <div>同意頂ける方は、下のチェックボックスを入れてください。</div>
            <div class="form-check">
                <div><label for="agree" class="form-check-label"><input type="checkbox" name="agree" id="agree" class="form-check-input me-2">同意する</label></div>
            </div>
        </div>
        <div>
            <button type="submit" id="submit" class="btn btn-primary mt-4">確認画面へ</button>
            <button id="loading" class="btn btn-dark mt-4" disabled>確認画面へ</button>
        </div>
    </div>
</form>

<script>
    //同意にチェックすると応募ボタン有効化
    $(function () {
        $('#submit').attr('disabled', 'disabled');
        $('#agree').click(function () {
            btnDisabled();
        });

        //送信ボタンを押した際に送信ボタンを無効化する（連打による多数送信回避）
        $('#submit').click(function () {
            $(this).hide();
            $('#loading').show();
        });

        function btnDisabled() {
            if ($('#agree').prop('checked') == false) {
                $('#submit').attr('disabled', 'disabled');
            } else {
                $('#submit').removeAttr('disabled');
            }
        }
    });

</script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
@endsection
