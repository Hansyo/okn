@extends('home')
@section('content')
<div class="body-main">
<form method="POST" action="{{ route("stores.update", $item->id) }}">
    @csrf
    @method('PUT')
    <label>name</label><input id="name" type="text" name="name" value="{{ $item->name }}"/><br>
    <label>memo</label><input id="memo" type="text" name="memo" value="{{ $item->memo }}"/><br>
    <label>parent</label><select id="parent" name="parent">
        <option value="">必要であれば選択</option>
        @foreach ($stores as $s)
        @if($s->id != $item->id)
        <option value="{{ $s->id }}" @if ($item->parent === $s->id) selected @endif >{{ $s->name }}</option>
        @endif
        @endforeach
    </select><br>
    <label>genre</label><select id="genre" name="genre">
        <option value="">必要であれば選択</option>
        @foreach ($genres as $s)
        <option value="{{ $s->id }}" @if ($item->genre === $s->id) selected @endif >{{ $s->name }}</option>
        @endforeach
    </select><br>
    <button type="submit"> 登録 </button>
</form>
<button type="button" onclick="location.href='{{ route('stores.show', $item->id) }}'"> Cancel </button>
</div>
@endsection
