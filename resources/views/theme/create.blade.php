@extends('layouts.basic')

@section('title', 'テーマ作成')

@section('content')
<main class="max-w-2xl mx-auto px-4 py-10 space-y-8">

  <h1 class="text-2xl font-bold text-center">テーマ作成</h1>

  @if (session('success'))
    <p class="text-green-600 text-center font-medium">{{ session('success') }}</p>
  @endif

  <form action="{{ route('themes.store') }}" method="POST" class="bg-white shadow-md rounded-xl p-6 space-y-6">
    @csrf

    <div>
      <label class="block font-semibold mb-1">テーマ名：</label>
      <input type="text" name="theme_name" required
             class="w-full border rounded px-3 py-2">
    </div>

    <div>
      <label class="block font-semibold mb-1">カテゴリ選択：</label>
      @if ($categories->isNotEmpty())
        <select name="category_id" id="category-select" class="w-full border rounded px-3 py-2">
          <option value="">-- 選択してください --</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
      @else
        <p class="text-sm text-gray-500">登録されたカテゴリがありません。新しく作成してください。</p>
      @endif

      <div id="new-category-area" class="mt-3 hidden">
        <label class="block font-semibold mb-1">新規カテゴリ名：</label>
        <input type="text" name="category_name" class="w-full border rounded px-3 py-2">
      </div>

      <button type="button" id="toggle-category"
              class="mt-2 text-blue-600 text-sm hover:underline">
        新しいカテゴリを追加
      </button>
    </div>

    <div>
      <label class="block font-semibold mb-1">単語リスト（改行区切り）：</label>
      <textarea name="word_list" rows="6" class="w-full border rounded px-3 py-2"
                placeholder="例：クラウド&#10;サーバー&#10;仮想化"></textarea>
    </div>

    <div class="flex items-center gap-2">
      <input type="checkbox" name="is_public" value="1" class="w-5 h-5">
      <label class="font-semibold">公開する</label>
    </div>

    <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
      登録
    </button>
  </form>
</main>

<script>
  document.getElementById("toggle-category").addEventListener("click", function () {
    const area = document.getElementById("new-category-area");
    area.classList.toggle("hidden");

    const select = document.getElementById("category-select");
    if (select) select.value = "";
  });
</script>
@endsection
