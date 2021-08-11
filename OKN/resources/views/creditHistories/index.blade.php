@extends('base')
@section('main-section')
<div class="body-main">
    <table border="1">
    <tr><th>支払い日</th><th>支払い方法</th><th>メモ</th></tr>
    @foreach ($items as $item)
    <tr><td><a href="{{route('creditHistories.show', $item->id)}}">{{ $item->date }}</a></td><td><a href="{{route('credits.show', $item->credit)}}">{{ $item->credit }}</a><td>{{ $item->memo }}</td></tr>
    @endforeach
</table>
</div>
@endsection
