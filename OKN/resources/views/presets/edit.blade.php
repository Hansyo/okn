@extends('home')
@section('content')
<div class="body-main">
<form method="POST" action="{{ route("presets.update", $item->id) }}">
    @csrf
    @method('PUT')
    <label>name</label><input id="name" type="text" name="name" value="{{ $item->name }}"/><br>
    <label>price</label><input id="price" type="number" name="price" value="{{ $item->price }}"/><br>
    <label>memo</label><input id="memo" type="text" name="memo" value="{{ $item->memo }}"/><br>
    <label>genre</label><select id="genre" name="genre">
        <option value="">必要であれば選択</option>
        @foreach ($genres as $tmp)
        @if($tmp->id != $item->id)
        <option value="{{ $tmp->id }}" @if ($item->genre === $tmp->id) selected @endif >{{ $tmp->name }}</option>
        @endif
        @endforeach
    </select><br>
    <label>store</label><select id="store" name="store">
        <option value="">必要であれば選択</option>
        @foreach ($stores as $tmp)
        @if($tmp->id != $item->id)
        <option value="{{ $tmp->id }}" @if ($item->store === $tmp->id) selected @endif >{{ $tmp->name }}</option>
        @endif
        @endforeach
    </select><br>
    <label>payment</label><select id="payment" name="payment">
        <option value="">必要であれば選択</option>
        @foreach ($payments as $tmp)
        @if($tmp->id != $item->id)
        <option value="{{ $tmp->id }}" @if ($item->payment === $tmp->id) selected @endif >{{ $tmp->name }}</option>
        @endif
        @endforeach
    </select><br>
    <button type="submit"> 登録 </button>
</form>
<button type="button" onclick="location.href='{{ route('presets.show', $item->id) }}'"> Cancel </button>
</div>
@endsection
