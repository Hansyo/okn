@extends('base')
@section('main-section')
<div class="body-main">
    <table border="1">
    <tr><th>ジャンル名</th><th>メモ</th></tr>
    @foreach ($stores as $item)
    <tr><td><a href="{{route('stores.show', $item->id)}}">{{ $item->name }}</a></td><td>{{ $item->memo }}</td></tr>
    @endforeach
</table>
<button type="button" onclick="location.href='{{ route('stores.create') }}'">新規追加</button>
</div>
@endsection
