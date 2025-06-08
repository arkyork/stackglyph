<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-6xl mx-auto">
        <div class="text-2xl font-bold text-center text-black py-4 tracking-wide">
            <a href="/">重ね文字あてゲーム</a>
        </div>
        <nav class="flex justify-center gap-4 py-4 bg-white border-b border-gray-200">
            <a href="{{ route('categories.index') }}"
                class="flex items-center gap-1 px-4 py-2 rounded-full text-gray-700 bg-gray-100 hover:bg-blue-50 hover:text-blue-600 shadow-sm hover:shadow-md transition duration-300 ease-in-out">
                📁 <span class="hidden sm:inline">カテゴリ</span>
            </a>

            <a href="{{ route('ranking') }}"
                class="flex items-center gap-1 px-4 py-2 rounded-full text-gray-700 bg-gray-100 hover:bg-blue-50 hover:text-blue-600 shadow-sm hover:shadow-md transition duration-300 ease-in-out">
                🏆 <span class="hidden sm:inline">ランキング</span>
            </a>
            <a href="{{ route('search.index') }}"
            class="flex items-center gap-1 px-4 py-2 rounded-full text-gray-700 bg-gray-100 hover:bg-blue-50 hover:text-blue-600 shadow-sm hover:shadow-md transition duration-300 ease-in-out">
                🔍 <span class="hidden sm:inline">検索</span>
            </a>
            @auth
            <a href="{{ route('themes.index') }}"
                class="flex items-center gap-1 px-4 py-2 rounded-full text-gray-700 bg-gray-100 hover:bg-blue-50 hover:text-blue-600 shadow-sm hover:shadow-md transition duration-300 ease-in-out">
                🛠 <span class="hidden sm:inline">テーマ管理</span>
            </a>
            @endauth
            </nav>

    </div>
</header>
