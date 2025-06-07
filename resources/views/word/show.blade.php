@extends('layouts.basic')

@section('title', $word->text . " - 日本人なら…読めるよね？重ね文字クイズ！")

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

<main class="max-w-3xl mx-auto px-4 py-12 space-y-12">

  <h1 class="text-3xl font-bold text-center text-blue-700">{{ $text }} の詳細</h1>

  <div class="flex justify-center">
    <img src="{{ $base64Svg }}" alt="{{ $text }}の重ね文字" class=" bg-white border border-gray-200 rounded-xl shadow-md" />
  </div>

  @if($word->wordStatistics)
    <section class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
      <h2 class="text-xl font-semibold mb-4 text-blue-700">📊 統計情報</h2>
      <table class="w-full text-sm text-gray-700 border border-gray-200 rounded overflow-hidden">
        <tbody>
          @foreach([
            '出題回数' => $word->wordStatistics->play_count,
            '正解数' => $word->wordStatistics->correct_count,
            'ヒント使用' => $word->wordStatistics->hint_count,
            'フラッシュカード使用' => $word->wordStatistics->flashcard_count,
            '正解率' => $word->wordStatistics->play_count > 0
              ? round($word->wordStatistics->correct_count / $word->wordStatistics->play_count * 100, 1) . '%'
              : '-',
          ] as $label => $value)
            <tr class="border-b last:border-0 even:bg-gray-50">
              <th class="text-left px-4 py-2 w-1/2 font-medium text-gray-600">{{ $label }}</th>
              <td class="px-4 py-2">{{ $value }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </section>
  @else
    <p class="text-gray-500 text-center">統計情報はまだありません。</p>
  @endif

  <section>
    <h2 class="text-xl font-semibold mb-4 text-blue-700">🧩 使用されているクイズ</h2>
    <ul class="space-y-4">
      @foreach($word->themes as $theme)
        <li class="bg-white border border-gray-200 rounded-lg shadow-sm px-4 py-3">
          <div class="font-semibold text-gray-800 text-lg">{{ $theme->name }}</div>
          <div class="text-sm text-gray-500 mb-1">カテゴリ：{{ $theme->category->name ?? '未設定' }}</div>
          <a href="{{ route('quiz.show', $theme->id) }}"
             class="text-blue-500 hover:text-blue-600 hover:underline text-sm">▶ クイズをプレイ</a>
        </li>
      @endforeach
    </ul>
  </section>

  <div class="text-center mt-10">
    <a href="/"
       class="inline-block px-4 py-2 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 transition">
       ← ホームに戻る
    </a>
  </div>

</main>
@endsection
