@extends('layouts.basic')

@section('title', $title.'ランキング - 重ね文字クイズ')

@section('content')

<h1 class="text-2xl font-bold text-center text-blue-700 mb-6">{{$title}}ランキング</h1>

<div class="flex justify-center gap-4 text-sm py-2">
    <a href="{{ route('ranking.play_count') }}" class="text-gray-600 hover:text-blue-600 hover:underline transition">出題回数</a>
    <a href="{{ route('ranking') }}" class="text-gray-600 hover:text-blue-600 hover:underline transition">正解率</a>
    <a href="{{ route('ranking.correct_count') }}" class="text-gray-600 hover:text-blue-600 hover:underline transition">正解数</a>
    <a href="{{ route('ranking.hint_count') }}" class="text-gray-600 hover:text-blue-600 hover:underline transition">ヒント使用</a>
    <a href="{{ route('ranking.flashcard_count') }}" class="text-gray-600 hover:text-blue-600 hover:underline transition">フラッシュカード</a>
  </div>

<table class="w-full text-sm text-gray-700 bg-white border border-gray-200 rounded shadow-sm">
  <thead class="bg-slate-100 text-left">
    <tr>
      <th class="px-4 py-2">順位</th>
      <th class="px-4 py-2">単語</th>
      <th class="px-4 py-2">フラッシュカード利用回数</th>
    </tr>
  </thead>
  <tbody>
  @php
    $rank = 0;
    $prevCount = null;
    $displayRank = 0;
  @endphp

  @foreach($words as $index => $word)
    @php
      $rank++;
      if ($word->wordStatistics->play_count !== $prevCount) {
          $displayRank = $rank;
          $prevCount = $word->wordStatistics->flashcard_count;
      }
    @endphp
    <tr class="border-t">
      <td class="px-4 py-2">{{ $displayRank }}</td>
      <td class="px-4 py-2">
        <a href="{{ route('words.show', $word->id) }}" class="text-blue-600 hover:underline">{{ $word->text }}</a>
      </td>
      <td class="px-4 py-2">{{ $word->wordStatistics->flashcard_count }}</td>
    </tr>
  @endforeach
  </tbody>
</table>

@endsection
