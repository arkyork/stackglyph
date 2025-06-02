@extends('layouts.basic')

@section('title', $theme->name. " - 日本人なら…読めるよね？重ね文字クイズ！")

@section('head')
  @vite('resources/js/quiz.js')
  <script>
    document.addEventListener("DOMContentLoaded", function() {
        const words = @json($words);
        const csrfToken = '{{ csrf_token() }}';
        setupQuiz(words, csrfToken);
    });
  </script>
  <meta name="description" content="『{{$theme->name}}』の重ね文字クイズ。日本人なら…読めるかも？">
@endsection

@section('content')
<main class="max-w-3xl mx-auto px-4 py-8 space-y-6">
  <a href="{{route('categories.show',$theme->category->id)}}" class="px-3 py-2 bg-slate-200 rounded-md">
    {{$theme->category->name}}
  </a>
  <h1 class="text-2xl font-bold text-center">「{{ $theme->name }}」の重ね文字</h1>

  <!-- プログレスバー -->
  <div class="w-full h-6 bg-gray-300 rounded overflow-hidden">
    <div id="progress-bar" class="h-full bg-green-500 text-white text-sm text-center" style="width: 0%"></div>
  </div>

  <!-- クイズエリア -->
  <div id="quiz-area" class="space-y-4">
    <p id="counter" class="text-center text-sm text-gray-600"></p>

    <div id="mysvg-container" class="mb-4 flex justify-center"></div>

    <div class="flex justify-center gap-4">
      <button id="remove-btn" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition">一文字消す</button>
      <button id="hint-btn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">フラッシュカード</button>
    </div>

    <div class="flex justify-center gap-2 items-center">
      <input id="answer" type="text" class="border rounded px-3 py-2 w-1/2" placeholder="答えを入力">
      <button id="check-btn" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">答え合わせ</button>
    </div>

    <div id="result" class="text-center text-lg font-semibold text-purple-600"></div>

    <div class="text-center">
      <button id="next-btn" class="hidden mt-4 bg-gray-700 text-white px-5 py-2 rounded hover:bg-gray-800 transition">次の問題へ</button>
    </div>
  </div>

  <!-- モーダル -->
  <div id="modal-bg" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div id="modal" class="bg-white p-8 rounded-2xl shadow-xl text-4xl min-w-[200px] min-h-[100px] flex items-center justify-center"></div>
  </div>

</main>


@endsection
