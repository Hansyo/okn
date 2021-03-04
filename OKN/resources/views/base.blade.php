<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'OKN')</title>
    <meta name="description" content="@yield('description')">

    @section('style')
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @show
</head>
<body>
    <header class="header">
        <nav class="navi navi-main content-center">
            <a href="{{ route('home') }}" class="navi-logo link-clear">
                OKN  <!-- ロゴ -->
            </a>
            <div class="navi-main-right">
                @section('navi-main-right')
                @auth
                <div>通知</div>
                <div>
                <a href="{{ route('dashboard') }}" class="link-clear">
                    <div class="navi-btn btn-color"> ユーザ</a></div>
                @endauth
                @guest
                <a href="{{ route('login') }}" class="link-clear">
                    <div class="navi-btn btn-clear">ログイン</div>
                </a>
                <a href="{{ route('register') }}" class="link-clear">
                    <div class="navi-btn btn-color">新規登録</div>
                </a>
                @endauth
                @show
            </div>
        </nav>
        <nav class="navi navi-sub content-center">
            @section('navi-sub')
            <div class="navi-sub-left">
                @section('navi-sub-left')
                <ul class="navi-menu">
                    <li>ホーム</li>
                    <li>メニュー</li>
                    <li>メニュー</li>
                    <li>メニュー</li>
                </ul>
                @show
            </div>
            <div class="navi-sub-right">
                @section('navi-sub-right')
                @show
            </div>
            @show
        </nav>
    </header>

    <div class="body">
        <div class="body-content content-center">
            @yield('content')
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content content-center">フッター</div>
    </footer>
</body>
</html>
