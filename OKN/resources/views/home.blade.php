@extends('base')

@section('content')
            <div class="body-main">メイン<br>コンテンツだよーん</div>
            <div class="body-sub">サブ</div>
@endsection

@auth
@section('navi-sub-left')
    <ul class="navi-menu">
        <li><a href="{{ route('home') }}">ホーム</a></li>
        <li><a href="{{ route('genres.index') }}">ジャンル一覧</a></li>
        <li><a href="{{ route('receipts.index') }}">レシート一覧</a></li>
        <li><a href="{{ route('stores.index') }}">店舗一覧</a></li>
        <li><a href="{{ route('paymentGenres.index') }}">支払いジャンル一覧</a></li>
        <li><a href="{{ route('payments.index') }}">支払い方法一覧</a></li>
        <li><a href="{{ route('presets.index') }}">プリセット一覧</a></li>
        <li><a href="{{ route('incomeGenres.index') }}">収入ジャンル一覧</a></li>
    </ul>
@endsection
@endauth

