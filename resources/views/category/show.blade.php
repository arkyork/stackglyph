<h1>カテゴリ：{{ $category->name }}</h1>
<p><a href="{{ route('categories.index') }}">← 戻る</a></p>

@if($themes->isEmpty())
  <p>このカテゴリにはテーマがありません。</p>
@else
  <ul>
    @foreach($themes as $theme)
      <li>
        <strong>{{ $theme->name }}</strong>
        （{{ $theme->words_count }}単語 /
        {{ $theme->is_public ? '公開' : '非公開' }}）
        <a href="{{ route('quiz.show', $theme->id) }}">▶ クイズ</a>
        <a href="{{ route('themes.edit', $theme->id) }}">✎ 編集</a>
      </li>
    @endforeach
  </ul>
@endif
