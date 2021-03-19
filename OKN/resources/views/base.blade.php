<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'OKN')</title>
        <meta name="description" content="家計簿入門アプリ OKN">

        <link rel="stylesheet" href="{{ asset('/css/destyle.css') }}">
        @section('stylesheet')
        <link rel="stylesheet" href="{{ asset('/css/base.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/layout.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/element.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/block.css') }}">
        @show
        @yield('script')
    </head>
    <body>
        @include('header')

        <div class="ly-body">
            <main class="ly-main">
            @yield('main-section')
            </main>
        </div>

        @include('footer')
    </body>
</html>
