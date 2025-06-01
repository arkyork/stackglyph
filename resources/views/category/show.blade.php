@extends('layouts.basic')

@section('title', 'カテゴリ：' . $category->name)

@section('content')

  <h1 class="text-2xl font-bold text-center">カテゴリ：{{ $category->name }}</h1>

  <div class="text-center">
    <a href="{{ route('categories.index') }}"
       class="inline-block text-blue-600 hover:underline mt-2">← 戻る</a>
  </div>

  @if($themes->isEmpty())
    <p class="text-center text-gray-500 mt-6">このカテゴリにはテーマがありません。</p>
  @else
    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">
      @foreach($themes as $theme)
        <li class="bg-white border rounded-xl shadow p-5 space-y-2">
          <div class="text-lg font-semibold text-gray-800">{{ $theme->name }}</div>
          <div class="text-sm text-gray-600">
            {{ $theme->words_count }} 単語
            @auth /
                <span class="{{ $theme->is_public ? 'text-green-600' : 'text-red-500' }}">
                {{ $theme->is_public ? '公開' : '非公開' }}
                </span>
            @endauth
          </div>
          <div class="flex gap-4 mt-2 text-sm">
            <a href="{{ route('quiz.show', $theme->id) }}"
               class="text-blue-600 hover:underline">▶ プレイ</a>
            @auth
                <a href="{{ route('themes.edit', $theme->id) }}"
                class="text-gray-600 hover:underline">✎ 編集</a>
            @endauth

          </div>
        </li>
      @endforeach
    </ul>
  @endif

@endsection

