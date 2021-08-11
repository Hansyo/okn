@extends('base')
@section('main-section')
<div class="body-main">
<form method="POST" action="{{ route("payments.update", $item->id) }}">
    @csrf
    @method('PUT')
    <label>name</label><input id="name" type="text" name="name" value="{{ $item->name }}"/><br>
    <label>memo</label><input id="memo" type="text" name="memo" value="{{ $item->memo }}"/><br>
    <label>Genre</label><select id="paymentGenre" name="paymentGenre">
        <option value="">必要であれば選択</option>
        @foreach ($paymentGenres as $tmp)
        <option value="{{ $tmp->id }}" @if ($item->paymentGenre === $tmp->id) selected @endif >{{ $tmp->name }}</option>
        @endforeach
    </select><br>
    <button type="submit"> 登録 </button>
</form>
<button type="button" onclick="location.href='{{ route('payments.show', $item->id) }}'"> Cancel </button>
</div>
@endsection
