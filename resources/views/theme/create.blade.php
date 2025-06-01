<h1>テーマ作成</h1>

@if (session('success'))
  <p style="color: green">{{ session('success') }}</p>
@endif

<form action="{{ route('themes.store') }}" method="POST">
  @csrf

  <div>
    <label>テーマ名：</label>
    <input type="text" name="theme_name" required>
  </div>

  <div>
    <label>カテゴリ選択：</label>
    @if ($categories->isNotEmpty())
      <select name="category_id" id="category-select">
        <option value="">-- 選択してください --</option>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      </select>
    @else
      <p>登録されたカテゴリがありません。新しく作成してください。</p>
    @endif

    <div id="new-category-area" style="margin-top: 1em; display: none;">
      <label>新規カテゴリ名：</label>
      <input type="text" name="category_name">
    </div>

    <button type="button" id="toggle-category">新しいカテゴリを追加</button>
  </div>

  <div>
    <label>単語リスト（改行区切り）：</label><br>
    <textarea name="word_list" rows="6" cols="60" placeholder="例：クラウド\nサーバー\n仮想化"></textarea>
  </div>

  <div>
    <label>公開する：</label>
    <input type="checkbox" name="is_public" value="1">
  </div>

  <button type="submit">登録</button>
</form>

<script>
  document.getElementById("toggle-category").addEventListener("click", function () {
    const area = document.getElementById("new-category-area");
    area.style.display = (area.style.display === "none") ? "block" : "none";

    // セレクトボックスも選択解除
    const select = document.getElementById("category-select");
    if (select) select.value = "";
  });
</script>
