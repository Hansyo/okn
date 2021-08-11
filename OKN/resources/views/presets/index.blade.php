@extends('base')
@section('main-section')
<div class="body-main">
    <table border="1">
    <tr><th>プリセット名</th><th>ジャンル</th><th>メモ</th></tr>
    @foreach ($items as $item)
    <tr><td><a href="{{route('presets.show', $item->id)}}">{{ $item->name }}</a></td><td>@if($item->genre)<a href="{{route('genres.show', $item->genre)}}">{{ $item->genre }}</a>@endif</td><td>{{ $item->memo }}</td></tr>
    @endforeach
</table>
<button type="button" onclick="location.href='{{ route('presets.create') }}'">新規追加</button>
</div>
@endsection
