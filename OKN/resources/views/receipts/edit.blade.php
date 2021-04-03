@extends('base')

@section('main-section')
<section class="bl-mainSection">
    <h2 class="bl-mainSection-title">レシート編集</h2>
    <div class="bl-mainSection-content bl-receiptEditUnit">
        <form method="POST" action="{{ route("receipts.update", $item->id) }}">
            @csrf
            @method('PUT')
            <fieldset class="bl-fieldset">
                <label>purchase</label><input id="purchase" type="date" name="purchase" value="{{ $item->purchase }}">
                <label>amount</label><input id="amount" type="number" name="amount" value="{{ $item->amount }}">
                <label>memo</label><input id="memo" type="text" name="memo" value="{{ $item->memo }}">
                <label>genre</label><select id="genre" name="genre">
                    @foreach($genres as $g)
                    <option value="{{ $g->id }}" @if($item->genre === $g->id) selected @endif>{{ $g->name }}</option>
                    @endforeach
                </select>
                <label>store</label><select id="store" name="store">
                    <option value="">必要であれば選択</option>
                    @foreach($stores as $g)
                    <option value="{{ $g->id }}" @if($item->store === $g->id) selected @endif>{{ $g->name }}</option>
                    @endforeach
                </select>
            </fieldset>
            <button class="el-btn" type="submit">登録</button>
        </form>
        <a href="{{ route('receipts.show', $item->id) }}">キャンセル</a>
    </div>
</section>
@endsection
