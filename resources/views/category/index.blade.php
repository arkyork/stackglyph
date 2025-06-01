<h1>カテゴリ一覧</h1>
<ul>
  @foreach($categories as $category)
    <li>
      <a href="{{ route('categories.show', $category->id) }}">
        {{ $category->name }}（{{ $category->themes_count }}テーマ）
      </a>
    </li>
  @endforeach
</ul>
