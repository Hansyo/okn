@extends('base')

@section('main-section')
<section class="bl-mainSection">
    <h2 class="bl-mainSection-title">レシート作成</h2>
    <div class="bl-mainSection-content bl-receiptCreateUnit">
        <form method="POST" action="{{ route('receipts.store') }}">
            @csrf
            <fieldset class="bl-fieldset">
                <label>purchase</label><input id="name" type="date" name="purchase">
                <label>amount</label><input id="name" type="number" name="amount">
                <label>memo</label><input id="memo" type="text" name="memo">
                <label>genre</label><select id="genre" name="genre">
                    @foreach($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
                <label>store</label><select id="store" name="store">
                    <option value="">必要なら以下から選択</option>
                    @foreach($stores as $store)
                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                    @endforeach
                </select>
                <label>payment</label><select id="payment" name="payment">
                    <option value="">必要なら以下から選択</option>
                    @foreach($payments as $payment)
                    <option value="{{ $payment->id }}">{{ $payment->name }}</option>
                    @endforeach
                </select>
            </fieldset>
            <p>支払い方法はあとから変更できません。もう一度確認してください。</p>
            <button class="el-btn" type="submit">登録</button>
        </form>
    </div>
</section>
@endsection
