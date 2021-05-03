@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">入力</li>
            <li class="breadcrumb-item">確認</li>
            <li class="breadcrumb-item active" aria-current="page">完了</li>
        </ol>
    </nav>

    <h2>アンケートへのご回答ありがとうございました。</h2>
    <p>{{ $email }}宛に自動メールを送信いたしました。</p>
    <p>メールにクーポン引き換え画面用のURLをお送りしております。<br>
        こちらの引き換え画面をインフォメーションにご提示いただくことで、<br>
        ご利用いただけるクーポンとお引き換えいたします。</p>
    <p>詳しくはメールをご確認ください。</p>
</div>
@endsection
