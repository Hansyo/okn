<header class="ly-header">
    <div class="ly-header-inner">
        <h1 class="el-logo">
            <a href="{{ route('root') }}">OKN</a>
        </h1>
        <nav class="bl-globalNavi">
            <ul class="bl-globalNavi-body">
                <li><a href="{{ route('home') }}">ホーム</a></li>
                <li><a href="{{ route('book') }}">家計簿</a></li>
                <li><a href="{{ route('report')}}">家計レポート</a></li>
            </ul>
        </nav>
        <div class="bl-accountMenu">
            <img class="bl-accountMenu-avatar" src="{{ asset('/img/avatar.png') }}" alt="アカウントメニュー">
            <ul class="bl-accountMenu-body">
                <li><a href="">設定</a></li>
                <li><a href="">ログアウト</a></li>
            </ul>
        </div>
        <button class="el-btn el-btn--colorAccent" type="button">
            <a href="{{ route('receipts.create') }}">レシートを貼る</a>
        </button>
    </div>
</header>
