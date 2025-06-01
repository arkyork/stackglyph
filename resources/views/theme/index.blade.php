@extends('layouts.basic')

@section('title', '一覧 - 日本人なら…読めるよね？重ね文字クイズ！')

@section('content')
<main class="max-w-6xl mx-auto px-4 py-10 space-y-12">

  <h1 class="text-2xl font-bold text-center">テーマ別 単語統計 一覧</h1>

  @foreach($themes as $theme)
    <section class="space-y-1">
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
    </section>
  @endforeach

</main>
@endsection
