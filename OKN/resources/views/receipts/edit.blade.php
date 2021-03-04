@extends('home')
@section('content')
<div class="body-main">
<form method="POST" action="{{ route("receipts.update", $item->id) }}">
    @csrf
    @method('PUT')
    <label>purchase</label><input id="purchase" type="date" name="purchase" value="{{ $item->purchase }}"/><br>
    <label>amount</label><input id="amount" type="number" name="amount" value="{{ $item->amount }}"/><br>
    <label>memo</label><input id="memo" type="text" name="memo" value="{{ $item->memo }}"/><br>
    <label>genre</label><select id="genre" name="genre">
        @foreach ($genres as $g)
        <option value="{{ $g->id }}" @if ($item->genre === $g->id) selected @endif >{{ $g->name }}</option>
        @endforeach
    </select><br>
    <label>store</label><select id="store" name="store">
        <option value="">必要であれば選択</option>
        @foreach ($stores as $g)
        <option value="{{ $g->id }}" @if ($item->store === $g->id) selected @endif >{{ $g->name }}</option>
        @endforeach
    </select><br>
    <button type="submit"> 登録 </button>
</form>
<button type="button" onclick="location.href='{{ route('receipts.show', $item->id) }}'"> Cancel </button>
</div>
@endsection
