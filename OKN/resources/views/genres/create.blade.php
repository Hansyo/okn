@extends('base')
@section('main-section')
<div class="body-main">
<form method="POST" action="/genres">
    @csrf
    <label>name</label><input id="name" type="text" name="name" /><br>
    <label>memo</label><input id="memo" type="text" name="memo" /><br>
    <label>parent</label><select id="parent" name="parent">
        <option value="">必要であれば選択</option>
        @foreach ($genres as $genre)
        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
        @endforeach
    </select><br>
    <button type="submit"> 登録 </button>
</form>
</div>
@endsection
