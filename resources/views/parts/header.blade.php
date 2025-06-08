<header class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-6xl mx-auto px-4 py-3">
        <!-- サイトタイトル（サブ的） -->
        <div class="text-center text-lg text-gray-800 tracking-wide font-semibold">
            <a href="/" class="hover:text-blue-500 transition">重ね文字あてゲーム</a>
        </div>

        <!-- ナビゲーション -->
        <nav class="flex flex-wrap justify-center gap-3 py-3 mt-2">
            <a href="{{ route('categories.index') }}"
                class="flex items-center gap-2 px-5 py-2 rounded-full bg-gray-50 border border-gray-200 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition shadow-sm">
                📁 <span class="hidden sm:inline">カテゴリ</span>
            </a>
            <a href="{{ route('ranking') }}"
                class="flex items-center gap-2 px-5 py-2 rounded-full bg-gray-50 border border-gray-200 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition shadow-sm">
                🏆 <span class="hidden sm:inline">ランキング</span>
            </a>
            <a href="{{ route('search.index') }}"
                class="flex items-center gap-2 px-5 py-2 rounded-full bg-gray-50 border border-gray-200 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition shadow-sm">
                🔍 <span class="hidden sm:inline">検索</span>
            </a>
            <a href="{{ route('quiz.random') }}"
                class="flex items-center gap-2 px-5 py-2 rounded-full bg-gray-50 border border-gray-200 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition shadow-sm">
                🎲 <span class="hidden sm:inline">ランダム</span>
            </a>
            @auth
            <a href="{{ route('themes.index') }}"
                class="flex items-center gap-2 px-5 py-2 rounded-full bg-gray-50 border border-gray-200 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition shadow-sm">
                🛠 <span class="hidden sm:inline">テーマ管理</span>
            </a>
            @endauth
        </nav>
    </div>
</header>
