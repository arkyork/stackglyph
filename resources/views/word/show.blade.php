@php
    $text = $word->text;
    $svgText = '';
    foreach (mb_str_split($text) as $char) {
        $svgText .= "<text x='50' y='110' font-size='100' font-family='serif'>{$char}</text>";
    }

    $svgContent = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="300" height="150">
  {$svgText}
</svg>
SVG;

    $base64Svg = 'data:image/svg+xml;base64,' . base64_encode($svgContent);
@endphp

<h1>単語詳細：{{ $text }}</h1>

<img src="{{ $base64Svg }}" alt="重ね文字SVG" style="display: block; background: #fff; border: 1px solid #ccc;" width="300" height="150" />

@if($word->wordStatistics)
  <h2>統計情報</h2>
  <ul>
    <li>出題回数：{{ $word->wordStatistics->play_count }}</li>
    <li>正解数：{{ $word->wordStatistics->correct_count }}</li>
    <li>ヒント使用：{{ $word->wordStatistics->hint_count }}</li>
    <li>フラッシュカード使用：{{ $word->wordStatistics->flashcard_count }}</li>
    <li>
      正解率：
      @if ($word->wordStatistics->play_count > 0)
        {{ round($word->wordStatistics->correct_count / $word->wordStatistics->play_count * 100, 1) }}%
      @else
        -
      @endif
    </li>
  </ul>
@else
  <p>統計情報はまだありません。</p>
@endif

<h2>使われている重ね文字クイズ</h2>
<ul>
  @foreach($word->themes as $theme)
    <li>
      {{ $theme->name }}
      （カテゴリ: {{ $theme->category->name ?? '未設定' }}）
      <a href="{{ route('quiz.show', $theme->id) }}">▶ プレイ</a>
    </li>
  @endforeach
</ul>

<p><a href="{{ route('themes.index') }}">← テーマ一覧に戻る</a></p>

<script>
  const text = @json($word->text);
  const svg = document.getElementById('word-svg');
  svg.innerHTML = ''; // 念のため空に

  for (let i = 0; i < text.length; i++) {
    const t = document.createElementNS("http://www.w3.org/2000/svg", "text");
    t.setAttribute("x", 50);
    t.setAttribute("y", 110);
    t.setAttribute("font-size", 100);
    t.setAttribute("font-family", "serif");
    t.setAttribute("fill", "#000"); // 必要なら色調整
    t.textContent = text[i];
    svg.appendChild(t);
  }
</script>
