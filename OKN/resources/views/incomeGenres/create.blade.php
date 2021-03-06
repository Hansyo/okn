@extends('home')
@section('content')
<div class="body-main">
<form method="POST" action="{{ route('incomeGenres.store') }}">
    @csrf
    <label>name</label><input id="name" type="text" name="name" /><br>
    <label>memo</label><input id="memo" type="text" name="memo" /><br>
    <label>parent</label><select id="parent" name="parent">
        <option value="">必要であれば選択</option>
        @foreach ($incomeGenres as $tmp)
        <option value="{{ $tmp->id }}">{{ $tmp->name }}</option>
        @endforeach
    </select><br>
    <button type="submit"> 登録 </button>
</form>
</div>
@endsection
