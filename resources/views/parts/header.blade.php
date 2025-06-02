<header class="bg-slate-800 text-white shadow-md">
    <div class="mx-auto">
        <div class="text-3xl font-bold text-center p-4">
            <a href="/">重ね文字あてゲーム</a>
        </div>
        <nav class="text-xl pt-4 flex justify-center gap-6 text-sm pb-6 bg-slate-900">
            <a href="{{ route('categories.index') }}" class="hover:text-yellow-300 transition">カテゴリ</a>
            <a href="{{ route('ranking') }}" class="hover:text-yellow-300 transition">ランキング</a>
            @auth
            <a href="{{ route('themes.index') }}" class="hover:text-yellow-300 transition">テーマ管理</a>
            @endauth
        </nav>
    </div>
</header>