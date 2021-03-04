@extends('home')
@section('content')
<div class="body-main">
    <table border="1">
    <tr><th>支払い方法</th><th>メモ</th></tr>
    @foreach ($items as $item)
    <tr><td><a href="{{route('payments.show', $item->id)}}">{{ $item->name }}</a></td><td>{{ $item->memo }}</td></tr>
    @endforeach
</table>
<button type="button" onclick="location.href='{{ route('payments.create') }}'">新規追加</button>
</div>
@endsection
