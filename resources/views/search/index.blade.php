@extends('layouts.basic')

@section('title', '検索結果 - 日本人なら読めるよね')

@section("head")
  @if(request()->query())
    <meta name="robots" content="noindex, follow">
  @endif
@endsection
@section('content')
<h1 class="text-2xl font-bold mb-4"> 検索</h1>

<form method="GET" action="{{ route('search.index') }}"
      class="bg-white border border-gray-200 rounded-xl shadow p-6 mb-6 space-y-4 max-w-3xl mx-auto">
  <div class="flex flex-col sm:flex-row sm:items-center gap-4">
    <input type="text" name="q" placeholder="キーワード" value="{{ $query }}"
           class="flex-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">

    <select name="category"
            class="border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
      <option value="">すべてのカテゴリ</option>
      @foreach($categories as $cat)
        <option value="{{ $cat->id }}" {{ $categoryId == $cat->id ? 'selected' : '' }}>
          {{ $cat->name }}
        </option>
      @endforeach
    </select>

    <button type="submit"
            class="bg-blue-500 text-white rounded px-4 py-2 hover:bg-blue-600 transition shadow">
      🔍 検索
    </button>
  </div>
</form>

@if($themes->isEmpty() && $words->isEmpty())
  <p>一致する結果は見つかりませんでした。</p>
@endif

@if($themes->isNotEmpty())
  <h2 class="text-lg font-semibold mt-4">クイズの検索結果</h2>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-4">
    @foreach($themes as $theme)
      <a href="{{ route('quiz.show', $theme->id) }}"
         class="block bg-white rounded-xl shadow hover:shadow-lg transition p-5 border border-slate-200 hover:border-blue-400">
        <div class="text-lg font-semibold text-gray-800 mb-1">{{ $theme->name }}</div>
        <div class="text-sm text-gray-500">
          カテゴリ: {{ $theme->category->name ?? '未設定' }}<br>
          単語数: {{ $theme->words_count ?? $theme->words->count() }}個
        </div>
      </a>
    @endforeach
  </div>
@endif

@if($words->isNotEmpty())
  <h2 class="text-lg font-semibold mt-6">単語の検索結果</h2>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-4">
    @foreach($words as $word)
      <a href="{{ route('words.show', $word->id) }}"
         class="block bg-white rounded-xl shadow hover:shadow-lg transition p-5 border border-slate-200 hover:border-blue-400">
        <div class="text-xl font-bold text-gray-800 mb-2 text-center">{{ $word->text }}</div>

        @if($word->wordStatistics)
          <div class="text-sm text-gray-600 space-y-1">
            <p>出題回数：{{ $word->wordStatistics->play_count }}</p>
            <p>正解数：{{ $word->wordStatistics->correct_count }}</p>
            <p>正解率：
              @if ($word->wordStatistics->play_count > 0)
                {{ round($word->wordStatistics->correct_count / $word->wordStatistics->play_count * 100, 1) }}%
              @else
                -
              @endif
            </p>
          </div>
        @else
          <p class="text-sm text-gray-500">統計情報なし</p>
        @endif
      </a>
    @endforeach
  </div>
@endif

@endsection
