@extends('layouts.basic')

@section('title',$word->text . " - 日本人なら…読めるよね？重ね文字クイズ！")

@section('content')
@php
    $text = $word->text;
    $svgText = '';
    foreach (mb_str_split($text) as $char) {
        $svgText .= "<text x='50%' y='50%' font-size='100' font-family='serif' text-anchor='middle' dominant-baseline='middle'>{$char}</text>";
    }

    $svgContent = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="300" height="300">
  {$svgText}
</svg>
SVG;

    $base64Svg = 'data:image/svg+xml;base64,' . base64_encode($svgContent);
@endphp

<main class="max-w-3xl mx-auto px-4 py-10 space-y-10">

  <h1 class="text-2xl font-bold text-center">単語詳細：{{ $text }}</h1>

  <div class="flex justify-center">
    <img src="{{ $base64Svg }}" alt="重ね文字SVG" class="border rounded shadow" />
  </div>

  @if($word->wordStatistics)
    <section class="bg-white rounded-xl shadow p-6">
      <h2 class="text-xl font-semibold mb-4">統計情報</h2>
      <table class="min-w-full text-sm text-gray-800 border border-gray-200 rounded shadow-sm">
        <tbody>
            <tr class="border-b">
            <th class="bg-slate-50 text-left px-4 py-2 w-1/2 font-semibold">出題回数</th>
            <td class="px-4 py-2">{{ $word->wordStatistics->play_count }}</td>
            </tr>
            <tr class="border-b">
            <th class="bg-slate-50 text-left px-4 py-2 font-semibold">正解数</th>
            <td class="px-4 py-2">{{ $word->wordStatistics->correct_count }}</td>
            </tr>
            <tr class="border-b">
            <th class="bg-slate-50 text-left px-4 py-2 font-semibold">ヒント使用</th>
            <td class="px-4 py-2">{{ $word->wordStatistics->hint_count }}</td>
            </tr>
            <tr class="border-b">
            <th class="bg-slate-50 text-left px-4 py-2 font-semibold">フラッシュカード使用</th>
            <td class="px-4 py-2">{{ $word->wordStatistics->flashcard_count }}</td>
            </tr>
            <tr>
            <th class="bg-slate-50 text-left px-4 py-2 font-semibold">正解率</th>
            <td class="px-4 py-2">
                @if ($word->wordStatistics->play_count > 0)
                {{ round($word->wordStatistics->correct_count / $word->wordStatistics->play_count * 100, 1) }}%
                @else
                -
                @endif
            </td>
            </tr>
        </tbody>
        </table>

    </section>
  @else
    <p class="text-gray-500 text-center">統計情報はまだありません。</p>
  @endif

  <section>
    <h2 class="text-xl font-semibold mb-4">使われている重ね文字クイズ</h2>
    <ul class="space-y-3">
      @foreach($word->themes as $theme)
        <li class="bg-white rounded-lg shadow px-4 py-3">
          <div class="font-semibold text-gray-800">{{ $theme->name }}</div>
          <div class="text-sm text-gray-500 mb-1">カテゴリ：{{ $theme->category->name ?? '未設定' }}</div>
          <a href="{{ route('quiz.show', $theme->id) }}" class="text-blue-600 hover:underline text-sm">▶ プレイ</a>
        </li>
      @endforeach
    </ul>
  </section>

  <div class="text-center mt-6">
    <a href="{{ route('themes.index') }}" class="text-blue-600 hover:underline">← テーマ一覧に戻る</a>
  </div>

</main>
@endsection
