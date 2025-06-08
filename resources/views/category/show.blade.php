@extends('layouts.basic')

@section('title', 'カテゴリ：' . $category->name . " - 日本人なら…読めるよね？重ね文字クイズ！")

@section('content')

  <h1 class="text-3xl font-bold text-center text-blue-700">{{ $category->name }}</h1>

  <div class="text-center mt-2">
    <a href="{{ route('categories.index') }}"
       class="inline-block mt-2 px-4 py-2 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 transition">
      ← 戻る
    </a>
  </div>

  @if($themes->isEmpty())
    <p class="text-center text-gray-500 mt-8">このカテゴリにはテーマがありません。</p>
  @else
    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-8">
      @foreach($themes as $theme)
      
        <li class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md hover:border-blue-300 transition p-5 space-y-2">
          <a href="{{ route('quiz.show', $theme->id) }}">
          <div class="text-lg font-semibold text-gray-800">{{ $theme->name }}</div>
          <div class="text-sm text-gray-600 flex items-center gap-2">
            {{ $theme->words_count }} 単語
            @auth
              <span class="px-2 py-0.5 text-xs rounded-full
                {{ $theme->is_public ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                {{ $theme->is_public ? '公開' : '非公開' }}
              </span>
            @endauth
          </div>
          <div class="flex gap-4 mt-2 text-sm">
            @auth
              <a href="{{ route('themes.edit', $theme->id) }}"
                 class="text-gray-600 hover:underline">✎ 編集</a>
            @endauth
          </div>
          </a>
        </li>
      @endforeach
    </ul>
  @endif

@endsection
