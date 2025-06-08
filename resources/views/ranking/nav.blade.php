<div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4">
  <h2 class="text-base font-bold text-gray-700 mb-3">ランキング切り替え</h2>
  <div class="flex flex-wrap justify-center gap-2 text-sm">
    <a href="{{ route('ranking.play_count') }}"
       class="inline-block px-3 py-1 rounded-full bg-gray-100 text-gray-700 hover:bg-blue-500 hover:text-white transition">
      📊 出題回数
    </a>
    <a href="{{ route('ranking') }}"
       class="inline-block px-3 py-1 rounded-full bg-gray-100 text-gray-700 hover:bg-green-500 hover:text-white transition">
      ✅ 正解率
    </a>
    <a href="{{ route('ranking.correct_count') }}"
       class="inline-block px-3 py-1 rounded-full bg-gray-100 text-gray-700 hover:bg-purple-500 hover:text-white transition">
      💡 正解数
    </a>
    <a href="{{ route('ranking.hint_count') }}"
       class="inline-block px-3 py-1 rounded-full bg-gray-100 text-gray-700 hover:bg-red-500 hover:text-white transition">
      ❌ 消去回数
    </a>

    <a href="{{ route('ranking.flashcard_count') }}"
       class="inline-block px-3 py-1 rounded-full bg-gray-100 text-gray-700 hover:bg-yellow-500 hover:text-white transition">
      🃏 フラッシュカード
    </a>
  </div>
</div>
