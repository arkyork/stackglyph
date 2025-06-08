@extends('layouts.basic')

@section('title', 'カテゴリ一覧'. " - 日本人なら…読めるよね？重ね文字クイズ！")

@section('content')

  <h1 class="text-2xl font-bold mb-6 text-center">カテゴリ一覧</h1>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    @foreach($categories as $category)
      <a href="{{ route('categories.show', $category->id) }}"
         class="block bg-white rounded-xl shadow hover:shadow-lg transition p-5 border border-slate-200 hover:border-blue-400">
        <div class="text-lg font-semibold text-gray-800 mb-1">{{ $category->name }}</div>
        <div class="text-sm text-gray-500">{{ $category->themes_count }} クイズ</div>
      </a>
    @endforeach
  </div>

@endsection
