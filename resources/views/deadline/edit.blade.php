@extends('layouts.admin.auth.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">終了日時設定リスト編集画面</div>
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <p>{{ $message }}</p>
                    @endif

                    @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <p class="attention">{{ $error }}</p>
                        @endforeach
                    </ul>
                    @endif
                    <form action="{{ route('admin.deadline.update', $deadline->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="admin_code" class="col-md-6 col-form-label text-md-right">公開期間締め切り日時</label>
                            <div class="col-md-4">
                                <input type='text' name='end_publication_period' class="form-control" value='{{ $deadline->end_publication_period }}'><br>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-6 col-form-label text-md-right">クーポン引き換え締め切り日時</label>
                            <div class="col-md-4">
                                <input type='text' name='end_gift_redemption' class="form-control" value='{{ $deadline->end_gift_redemption }}'><br>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" name='action' value="edit">
                                    {{ __('変更') }}
                                </button>
                                <button type="submit" class="btn btn-info" name='action' value="back">
                                    {{ __('戻る') }}
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
