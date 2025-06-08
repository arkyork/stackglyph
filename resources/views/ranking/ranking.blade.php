@extends('layouts.basic')

@section('title', '正解率ランキング'. " - 日本人なら…読めるよね？重ね文字クイズ！")

@section('content')


  <h1 class="text-2xl font-bold text-center mb-4">正解率ランキング</h1>
  @include("ranking.nav")


  <div class="bg-white border border-gray-200 rounded-xl shadow p-4 px-1">
  <h2 class="text-xl text-center font-bold mb-4">ランキング</h2>
  <table class="w-full text-sm text-gray-800">
    <thead class="bg-slate-100 text-left border-b border-gray-300">
        <tr>
          <th class="px-4 py-3 font-semibold text-gray-700">単語</th>
          <th class="px-4 py-3 font-semibold text-gray-700">正解率</th>
          <th class="px-4 py-3 font-semibold text-gray-700">出題数</th>
          <th class="px-4 py-3 font-semibold text-gray-700">正解数</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        @foreach ($words as $stat)
          <tr class="hover:bg-slate-50">
            <td class="px-4 py-2"><a href="{{route('words.show', $stat->word->id)}}">{{ $stat->word->text }}</a></td>
            <td class="px-4 py-2">
              {{ $stat->correct_rate !== null ? $stat->correct_rate . '%' : '－' }}
            </td>
            <td class="px-4 py-2">{{ $stat->play_count }}</td>
            <td class="px-4 py-2">{{ $stat->correct_count }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
