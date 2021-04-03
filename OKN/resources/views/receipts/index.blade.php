@extends('base')

@section('main-section')
<section class="bl-mainSection">
    <h2 class="bl-mainSection-title">レシート一覧</h2>
    <div class="bl-mainSection-content bl-receiptUnit">
        <table class="bl-table">
            <thead>
                <tr><th>買い物日</th><th>ジャンル</th><th>メモ</th></tr>
            </thead>
            <tbody>
                @foreach ($items as $receipt)
                <tr>
                <td><a href="{{ route('receipts.show', $receipt->id) }}">{{ $receipt->purchase }}</a></td>
                <td><a href="{{ route('genres.show', $receipt->genre) }}">{{ $receipt->genre }}</a></td>
                <td>{{ $receipt->memo }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button class="el-btn" type="button"><a href="{{ route('receipts.create') }}">新規作成</a></button>
    </div>
</section>
@endsection
