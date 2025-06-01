<header class="bg-slate-800 text-white p-6 shadow-md">
    <div class="max-w-4xl mx-auto">
        <div class="text-2xl font-bold text-center">
            <a href="/">重ね文字あてゲーム</a>
        </div>
        <nav class="mt-4 flex justify-center gap-6 text-sm">
            <a href="{{ route('categories.index') }}" class="hover:text-yellow-300 transition">カテゴリ</a>
            <a href="{{ route('ranking') }}" class="hover:text-yellow-300 transition">ランキング</a>
            @auth
            <a href="{{ route('themes.index') }}" class="hover:text-yellow-300 transition">テーマ管理</a>
            @endauth
        </nav>
    </div>
</header>