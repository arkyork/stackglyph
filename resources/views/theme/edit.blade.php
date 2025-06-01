<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>テーマ編集</title>
</head>
<body>
  <h1>テーマ編集：{{ $theme->name }}</h1>
  <p><a href="{{ route('themes.index') }}">← 一覧に戻る</a></p>

  <form method="POST" action="{{ route('themes.update', $theme->id) }}">
    @csrf

    <div>
      <label>テーマ名：</label>
      <input type="text" name="name" value="{{ old('name', $theme->name) }}" required>
    </div>

    <div>
      <label>カテゴリ：</label>
      <select name="category_id" required>
        @foreach($categories as $category)
          <option value="{{ $category->id }}" {{ $theme->category_id == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
          </option>
        @endforeach
      </select>
    </div>

    <div>
      <label>公開する：</label>
      <input type="checkbox" name="is_public" value="1" {{ $theme->is_public ? 'checked' : '' }}>
    </div>
    <h2>単語の一括追加</h2>
<p>改行区切りで入力してください</p>
<textarea name="word_list" rows="6" cols="60" placeholder="例：\n従量課金\n仮想化\nクラウド"></textarea>
    <button type="submit">保存</button>
  </form>
  <h2>登録単語一覧</h2>

@if ($theme->words->isEmpty())
  <p>まだ単語がありません。</p>
@else
  <ul>
    @foreach($theme->words as $word)
      <li>
        {{ $word->text }}
        <form action="{{ route('themes.word.detach', [$theme->id, $word->id]) }}" method="POST" style="display:inline;">
          @csrf
          @method('DELETE')
          <button type="submit" onclick="return confirm('削除してよいですか？')">削除</button>
        </form>
      </li>
    @endforeach
  </ul>
@endif
</body>
</html>
