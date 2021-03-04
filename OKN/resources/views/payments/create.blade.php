@extends('home')
@section('content')
<div class="body-main">
<form method="POST" action="{{ route('payments.store') }}">
    @csrf
    <label>name</label><input id="name" type="text" name="name" /><br>
    <label>memo</label><input id="memo" type="text" name="memo" /><br>
    <label>genre</label><select id="paymentGenre" name="paymentGenre">
        <option value="">必要であれば選択</option>
        @foreach ($paymentGenres as $tmp)
        <option value="{{ $tmp->id }}">{{ $tmp->name }}</option>
        @endforeach
    </select><br>
    <input type="checkbox" id="noCredit" name="noCredit">残高が不要な人はチェック（クレジットカード等の場合です。）<br>
    <button type="submit"> 登録 </button>
</form>
</div>
@endsection
