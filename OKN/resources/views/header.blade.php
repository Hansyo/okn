<header class="ly-header">
    <div class="ly-header-inner">
        <h1 class="el-logo">
            <a href="{{ route('root') }}">OKN</a>
        </h1>
        <nav class="bl-globalNavi">
            <ul class="bl-globalNavi-body">
                <li class="bl-globalNavi-item @if(Request::routeIs('home')) is-current @endif"><a href="{{ route('home') }}"><div>ホーム</div></a></li>
                <li class="bl-globalNavi-item @if(Request::routeIs('book')) is-current @endif"><a href="{{ route('book') }}"><div>家計簿</div></a></li>
                <li class="bl-globalNavi-item @if(Request::routeIs('report')) is-current @endif"><a href="{{ route('report')}}"><div>家計レポート</div></a></li>
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
