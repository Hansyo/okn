@extends('base')
@section('main-section')
<div class="body-main">
<form method="POST" action="{{ route('incomes.store') }}">
    @csrf
    <label>date</label><input id="date" type="date" name="date" /><br>
    <label>amount</label><input id="amount" type="number" name="amount" /><br>
    <label>memo</label><input id="memo" type="text" name="memo" /><br>
    <label>genre</label><select id="incomeGenre" name="incomeGenre">
        <option value="">必要なら以下から選択</option>
        @foreach ($incomeGenres as $incomeGenre)
        <option value="{{ $incomeGenre->id }}">{{ $incomeGenre->name }}</option>
        @endforeach
    </select><br>
    <label>payment</label><select id="payment" name="payment">
        @foreach ($payments as $payment)
        <option value="{{ $payment->id }}">{{ $payment->name }}</option>
        @endforeach
    </select><br>
    <p>支払い方法はあとから変更できません。もう一度確認してください。</p>
    <button type="submit"> 登録 </button>
</form>
</div>
@endsection
