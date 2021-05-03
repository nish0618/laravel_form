@extends('layouts.admin.auth.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="content-header">
                <div class="container-fluid">
                    <h1>終了日時設定リスト</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th class="border-0 text-center"><small class="text-muted">id</small></th>
                                <th class="border-0 text-center"><small class="text-muted">公開期間終了日時</small></th>
                                <th class="border-0 text-center"><small class="text-muted">クーポン引き換え期間終了日時</small></th>
                                <th class="border-0 text-center"><small class="text-muted"></small></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($deadlines->isNotEmpty())
                            @foreach ($deadlines as $deadline)
                            <tr>
                                <td class="align-middle text-center"><small>{{ $deadline->id }}</small></td>
                                <td class="align-middle text-center"><small>{{ $deadline->end_publication_period->format('Y-m-d H:i') }}</small></td>
                                <td class="align-middle text-center"><small>{{ $deadline->end_gift_redemption->format('Y-m-d H:i') }}</small></td>
                                <td class="align-middle text-center"><small><button type="button" class="btn btn-info" onclick="location.href='{{ route('admin.deadline.edit', $deadline->id) }}'">編集する</button></small></td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <div class="d-flex justify-content-center">
                        @if ($deadlines->isNotEmpty())
                        {{ $deadlines->appends(request()->input())->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
