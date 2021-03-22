@extends('base')
@section('main-section')
<div class="body-main">
<form method="POST" action="{{ route("incomeGenres.update", $item->id) }}">
    @csrf
    @method('PUT')
    <label>name</label><input id="name" type="text" name="name" value="{{ $item->name }}"/><br>
    <label>memo</label><input id="memo" type="text" name="memo" value="{{ $item->memo }}"/><br>
    <label>parent</label><select id="parent" name="parent">
        <option value="">必要であれば選択</option>
        @foreach ($incomeGenres as $tmp)
        @if($tmp->id != $item->id)
        <option value="{{ $tmp->id }}" @if ($item->parent === $tmp->id) selected @endif >{{ $tmp->name }}</option>
        @endif
        @endforeach
    </select><br>
    <button type="submit"> 登録 </button>
</form>
<button type="button" onclick="location.href='{{ route('incomeGenres.show', $item->id) }}'"> Cancel </button>
</div>
@endsection
