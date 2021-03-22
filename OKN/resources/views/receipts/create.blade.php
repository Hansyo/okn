@extends('base')
@section('main-section')
<div class="body-main">
<form method="POST" action="{{ route('receipts.store') }}">
    @csrf
    <label>purchase</label><input id="name" type="date" name="purchase" /><br>
    <label>amount</label><input id="name" type="number" name="amount" /><br>
    <label>memo</label><input id="memo" type="text" name="memo" /><br>
    <label>genre</label><select id="genre" name="genre">
        @foreach ($genres as $genre)
        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
        @endforeach
    </select><br>
    <label>store</label><select id="store" name="store">
        <option value="">必要なら以下から選択</option>
        @foreach ($stores as $store)
        <option value="{{ $store->id }}">{{ $store->name }}</option>
        @endforeach
    </select><br>
    <label>payment</label><select id="payment" name="payment">
        <option value="">必要なら以下から選択</option>
        @foreach ($payments as $payment)
        <option value="{{ $payment->id }}">{{ $payment->name }}</option>
        @endforeach
    </select><br>
    <p>支払い方法はあとから変更できません。もう一度確認してください。</p>
    <button type="submit"> 登録 </button>
</form>
</div>
@endsection
