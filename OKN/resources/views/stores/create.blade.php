@extends('home')
@section('content')
<div class="body-main">
<form method="POST" action="{{ route('stores.store') }}">
    @csrf
    <label>name</label><input id="name" type="text" name="name" /><br>
    <label>memo</label><input id="memo" type="text" name="memo" /><br>
    <label>parent</label><select id="parent" name="parent">
        <option value="">必要であれば選択</option>
        @foreach ($stores as $s)
        <option value="{{ $s->id }}">{{ $s->name }}</option>
        @endforeach
    </select><br>
    <label>genre</label><select id="genre" name="genre">
        <option value="">必要であれば選択</option>
        @foreach ($genres as $g)
        <option value="{{ $g->id }}">{{ $g->name }}</option>
        @endforeach
    </select><br>
    <button type="submit"> 登録 </button>
</form>
</div>
@endsection
