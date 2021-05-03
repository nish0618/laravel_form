@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div>
        <p>インフォメーションでクーポン引き換え画面をご提示いただくとクーポンとお引き換えいたします。</p>
    </div>
    @if($coupon_flag === 0)
        <div id="apply"><button class="js-modal-open btn btn-primary">クーポンと引き換える</button></div>
        <div id="applied"><button class="btn btn-secondary" disabled>引き換え済み</button></div>
    @else
        <div id="applied"><button class="btn btn-secondary" disabled>引き換え済み</button></div>
    @endif
</div>

<!-- ▼modal -->
<div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
        <p>画面をインフォメーションスタッフに見せてから「引き換える」ボタンを押してください。<br>
            必ずインフォメーションスタッフの前で画面をお提示ください。</p>
        <p><span>また、一度 「引き換える」を押してしまうと<br>クーポンとお引き換えできませんので、予めご了承ください。</span></p>
        <button class="js-modal-close btn btn-secondary">戻る</button>
        <button class="js-modal-click btn btn-primary">引き換える</button>
    </div>
</div>
<!-- ▲modal -->
<script>
    $(function() {
        let unique_url = '{{ $unique_url }}';

        if (unique_url !== '') {
            $.ajax({
                type: 'get',
                datatype: 'json',
                url: '/redeem/'+ unique_url + '/applied',
                data: {
                    'unique_url': unique_url,
                }
            })
            .done(function(data) {
                // 応募済みなら応募ボタンを非表示にする
                if (data['coupon_flag'] === 1) {
                    $('#apply').hide();
                } else {
                    $('#applied').hide();
                }
            })
            .fail(function(data) {
                alert('処理に失敗しました。');
            });
        }

        $(".js-modal-open").on("click", function() {
            $.ajax({
                type: 'get',
                datatype: 'json',
                url: '/redeem/'+ unique_url + '/applied',
                data: {
                    'unique_url': unique_url,
                }
            })
            .done(function(data) {
                // 応募済みなら応募ボタンを非表示にする
                if (data['coupon_flag'] === 1) {
                    $('.js-modal').hide();
                    alert('こちらのクーポン引き換え画面は、すでにクーポンとの引き換えが実行済みとなっております。');
                    $('#apply').hide();
                    $('#applied').show();
                } else {
                    $('.js-modal').fadeIn();
                    return false;
                }
            })
            .fail(function(data) {
                alert('こちらのクーポン引き換え画面は、すでにクーポンとの引き換えが実行済みとなっております。');
            });
        });

        $('.js-modal-close').on('click',function(){
            $('.js-modal').fadeOut();
            return false;
        });
        $('.js-modal-click').on('click',function(){

            $.ajax({
                type: 'get',
                datatype: 'json',
                url: '/redeem/'+ unique_url + '/applied',
                data: {
                    'unique_url': unique_url,
                }
            })
            .done(function(data) {
                // 応募済みなら応募ボタンを非表示にする
                if (data['coupon_flag'] === 1) {
                    $('.js-modal').hide();
                    alert('こちらのクーポン引き換え画面は、すでにクーポンとの引き換えが実行済みとなっております。');
                    $('#apply').hide();
                    $('#applied').show();
                } else {
                    applyPost(unique_url);
                }
            })
            .fail(function(data) {
                alert('処理に失敗しました。');
            });
        });
    });

    function applyPost(unique_url) {
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'post',
            datatype: 'json',
            url: '/redeem/' + unique_url + '/apply',
            data: {
                '_token': _token,
                'unique_url': unique_url,
            }
        })
        .done(function (data) {
            // 登録が成功すれば応募ボタンを非表示
            if (data['status'] == 200) {
                $('#apply').hide();
                $('#applied').show();
            }
        })
        .fail(function (data) {
            alert('処理に失敗しました。');
        })
        .always(function (data) {
            $('.js-modal').fadeOut();
        });
    }
</script>
@endsection
