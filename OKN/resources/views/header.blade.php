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
                <li class="bl-accountMenu-item"><a href="{{ route('genres.index') }}">ジャンル</a></li>
                <li class="bl-accountMenu-item"><a href="{{ route('payments.index') }}">支払い方法</a></li>
                <li class="bl-accountMenu-item"><a href="{{ route('paymentGenres.index') }}">支払い方法ジャンル</a></li>
                <li class="bl-accountMenu-item"><a href="{{ route('incomes.index') }}">収入</a></li>
                <li class="bl-accountMenu-item"><a href="{{ route('incomeGenres.index') }}">収入ジャンル</a></li>
                <li class="bl-accountMenu-item"><a href="{{ route('stores.index') }}">店舗</a></li>
                <li class="bl-accountMenu-item"><a href="{{ route('presets.index') }}">プリセット</a></li>
                <button class="el-btn el-btn--colorAccent"><a href="">ログアウト</a></button>
            </ul>
        </div>
        <button class="el-btn el-btn--colorAccent" type="button">
            <a href="{{ route('receipts.create') }}">レシートを貼る</a>
        </button>
    </div>
</header>
