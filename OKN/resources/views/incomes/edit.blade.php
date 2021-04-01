@extends('base')
@section('main-section')
<div class="body-main">
<form method="POST" action="{{ route("incomes.update", $item->id) }}">
    @csrf
    @method('PUT')
    <label>date</label><input id="date" type="date" name="date" value="{{ $item->date }}"/><br>
    <label>amount</label><input id="amount" type="number" name="amount" value="{{ $item->amount }}"/><br>
    <label>memo</label><input id="memo" type="text" name="memo" value="{{ $item->memo }}"/><br>
    <label>genre</label><select id="incomeGenre" name="incomeGenre">
        @foreach ($incomeGenres as $g)
        <option value="{{ $g->id }}" @if ($item->incomeGenre === $g->id) selected @endif >{{ $g->name }}</option>
        @endforeach
    </select><br>
    <button type="submit"> 登録 </button>
</form>
<button type="button" onclick="location.href='{{ route('incomes.show', $item->id) }}'"> Cancel </button>
</div>
@endsection
