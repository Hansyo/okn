@extends('base')
@section('main-section')
<div class="body-main">
    <table border="1">
    <tr><th>ジャンル名</th><th>メモ</th></tr>
    @foreach ($genres as $genre)
    <tr><td><a href="{{route('genres.show', $genre->id)}}">{{ $genre->name }}</a></td><td>{{ $genre->memo }}</td></tr>
    @endforeach
</table>
<button type="button" onclick="location.href='{{ route('genres.create') }}'">新規追加</button>
</div>
@endsection
