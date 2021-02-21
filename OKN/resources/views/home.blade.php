@extends('base')

@section('content')
            <div class="body-main">メイン<br>コンテンツだよーん</div>
            <div class="body-sub">サブ</div>
@endsection

@section('navi-sub-left')
@auth
    <ul class="navi-menu">
        <li><a href="{{ route('home') }}">ホーム</a></li>
        <li><a href="{{ route('genres.index') }}">ジャンル一覧</a></li>
    </ul>
@endauth
@endsection

