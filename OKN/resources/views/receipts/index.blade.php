@extends('home')
@section('content')
<div class="body-main">
    <table border="1">
    <tr><th>買い物日</th><th>ジャンル</th><th>メモ</th></tr>
    @foreach ($items as $receipt)
    <tr>
<td><a href="{{route('receipts.show', $receipt->id)}}">{{ $receipt->purchase }}</a></td>
<td><a href="{{route('genres.show', $receipt->genre_id)}}">{{ $receipt->genre_id }}</a></td>
<td>{{ $receipt->memo }}</td></tr>
    @endforeach
</table>
<button type="button" onclick="location.href='{{ route('receipts.create') }}'">新規追加</button>
</div>
@endsection
