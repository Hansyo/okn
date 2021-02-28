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
    </ul>
@endsection
@endauth

