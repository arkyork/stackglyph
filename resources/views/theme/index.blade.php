@extends('layouts.basic')

@section('title', '一覧 - 日本人なら…読めるよね？重ね文字クイズ！')

@section('content')
<main class="max-w-6xl mx-auto px-4 py-10 space-y-12">
    <form method="GET" action="{{ route('themes.index') }}" class="max-w-xl mx-auto mb-6">
    <div class="flex items-center gap-2">
        <input type="text" name="q" value="{{ request('q') }}"
            placeholder="テーマ名またはカテゴリ名で検索"
            class="w-4/5 border border-gray-300 rounded px-4 py-2 shadow-sm">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
        検索
        </button>
    </div>
  </form>
  <h1 class="text-2xl font-bold text-center">テーマ別 単語統計 一覧</h1>
  <section class="space-y-1">

  @foreach($themes as $theme)
      <h2 class="text-xl font-semibold">
        <a href="{{ route('themes.edit', $theme->id) }}" class="text-blue-600 hover:underline">
          {{ $theme->name }}
        </a>
        （{{ $theme->category->name }}）
        @if($theme->is_public)
          <span title="公開" class="ml-1">🌐</span>
        @else
          <span title="非公開" class="ml-1">🔒</span>
        @endif
      </h2>
  @endforeach
  </section>

</main>
@endsection
