@extends('base')
@section('main-section')
<div class="body-main">
<form method="POST" action="{{ route('presets.store') }}">
    @csrf
    <label>name</label><input id="name" type="text" name="name" /><br>
    <label>price</label><input id="price" type="number" name="price" /><br>
    <label>memo</label><input id="memo" type="text" name="memo" /><br>
    <label>genre</label><select id="genre" name="genre">
        <option value="">必要であれば選択</option>
        @foreach ($genres as $tmp)
        <option value="{{ $tmp->id }}">{{ $tmp->name }}</option>
        @endforeach
    </select><br>
    <label>store</label><select id="store" name="store">
        <option value="">必要であれば選択</option>
        @foreach ($stores as $tmp)
        <option value="{{ $tmp->id }}">{{ $tmp->name }}</option>
        @endforeach
    </select><br>
    <label>payment</label><select id="payment" name="payment">
        <option value="">必要であれば選択</option>
        @foreach ($payments as $tmp)
        <option value="{{ $tmp->id }}">{{ $tmp->name }}</option>
        @endforeach
    </select><br>
    <button type="submit"> 登録 </button>
</form>
</div>
@endsection
