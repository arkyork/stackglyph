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
    <label>カテゴリ名：</label>
    <input type="text" name="category_name" required>
  </div>


  <div>
    <label>単語リスト（改行区切り）：</label><br>
    <textarea name="word_list" rows="6" cols="60" placeholder="例：\nクラウド\nサーバー\n仮想化"></textarea>
  </div>
  <div>
    <label>公開する：</label>
    <input type="checkbox" name="is_public" value="1">
    </div>

  <button type="submit">登録</button>
</form>
