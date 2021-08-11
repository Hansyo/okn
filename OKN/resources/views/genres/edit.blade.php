@extends('base')
@section('main-section')
<div class="body-main">
<form method="POST" action="{{ route("genres.show", $item->id) }}">
    @csrf
    @method('PUT')
    <label>name</label><input id="name" type="text" name="name" value="{{ $item->name }}"/><br>
    <label>memo</label><input id="memo" type="text" name="memo" value="{{ $item->memo }}"/><br>
    <label>parent</label><select id="parent" name="parent">
        <option value="">必要であれば選択</option>
        @foreach ($genres as $g)
        @if($g->id != $item->id)
        <option value="{{ $g->id }}" @if ($item->parent === $g->id) selected @endif >{{ $g->name }}</option>
        @endif
        @endforeach
    </select><br>
    <button type="submit"> 登録 </button>
</form>
<button type="button" onclick="location.href='{{ route('genres.show', $item->id) }}'"> Cancel </button>
</div>
@endsection
