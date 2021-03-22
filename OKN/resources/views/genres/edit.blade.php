@extends('base')
@section('main-section')
<div class="body-main">
<form method="POST" action="{{ route("genres.show", $genre->id) }}">
    @csrf
    @method('PUT')
    <label>name</label><input id="name" type="text" name="name" value="{{ $genre->name }}"/><br>
    <label>memo</label><input id="memo" type="text" name="memo" value="{{ $genre->memo }}"/><br>
    <label>parent</label><select id="parent" name="parent">
        <option value="">必要であれば選択</option>
        @foreach ($genres as $g)
        @if($g->id != $genre->id)
        <option value="{{ $g->id }}" @if ($genre->parent === $g->id) selected @endif >{{ $g->name }}</option>
        @endif
        @endforeach
    </select><br>
    <button type="submit"> 登録 </button>
</form>
<button type="button" onclick="location.href='{{ route('genres.show', $genre->id) }}'"> Cancel </button>
</div>
@endsection
