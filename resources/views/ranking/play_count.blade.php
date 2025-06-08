@extends('layouts.basic')

@section('title', $title.'ランキング - 重ね文字クイズ')

@section('content')

<h1 class="text-2xl font-bold text-center text-blue-700 mb-6">{{$title}}ランキング</h1>

@include("ranking.nav")


<div class="bg-white border border-gray-200 rounded-xl shadow p-4 px-1">
  <h2 class="text-xl text-center font-bold mb-4">ランキング</h2>
  <table class="w-full text-sm text-gray-800">
    <thead class="bg-slate-100 text-left border-b border-gray-300">
    <tr>
      <th class="px-4 py-3 font-semibold text-gray-700">順位</th>
      <th class="px-4 py-3 font-semibold text-gray-700">単語</th>
      <th class="px-4 py-3 font-semibold text-gray-700">出題回数</th>
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
          $prevCount = $word->wordStatistics->play_count;
      }
    @endphp
    <tr class="border-t">
      <td class="px-4 py-2">{{ $displayRank }}</td>
      <td class="px-4 py-2">
        <a href="{{ route('words.show', $word->id) }}" class="text-blue-600 hover:underline">{{ $word->text }}</a>
      </td>
      <td class="px-4 py-2">{{ $word->wordStatistics->play_count }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
    </div>
@endsection
