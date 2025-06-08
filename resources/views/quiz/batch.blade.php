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
<div class="max-w-3xl mx-auto px-4 py-8 space-y-6">
  <a href="{{route('categories.show',$theme->category->id)}}" class="px-3 py-2 bg-slate-200 hover:bg-slate-500 hover:text-white rounded-md">
    {{$theme->category->name}}
  </a>
  <h1 class="text-3xl font-bold text-center">「{{ $theme->name }}」の重ね文字</h1>

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

    <div class="flex justify-center gap-2 items-center mb-8">
      <input id="answer" type="text" class="border rounded px-3 py-2 w-1/2" placeholder="答えを入力">
      <button id="check-btn" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">答え合わせ</button>
    </div>

    <div id="result" class="text-center text-lg font-semibold text-purple-600"></div>

    <div class="text-center">
      <button id="next-btn" class="hidden mt-4 bg-gray-700 text-white px-5 py-2 rounded hover:bg-gray-800 transition">次の問題へ</button>
    </div>

<!-- トグルボタン -->
<div class="text-center my-6">
  <button id="toggleHint"
          class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-full shadow hover:bg-blue-700 transition">
    <svg id="toggleIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform transition-transform" fill="none"
         viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 9l-7 7-7-7"/>
    </svg>
    
  </button>
</div>

<!-- トグル対象エリア -->
<div id="hintArea" class="hint-area bg-white rounded-2xl border p-6 max-w-3xl mx-auto hidden">
  <h2 class="text-2xl font-bold mb-6 text-slate-700 text-center">候補</h2>
  <div class="flex flex-wrap justify-center gap-4">
    @foreach($theme->words as $w)
      <button class="px-4 py-2 bg-gradient-to-r from-slate-200 to-slate-300 text-slate-800 hover:from-slate-500 hover:to-slate-600 hover:text-white transition-all duration-200 ease-in-out rounded-xl shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-400">{{$w->text}}</button>
    @endforeach
  </div>
</div>


  </div>

  <!-- モーダル -->
  <div id="modal-bg" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div id="modal" class="bg-white p-8 rounded-2xl shadow-xl text-4xl min-w-[200px] min-h-[100px] flex items-center justify-center"></div>
  </div>

</div>


@endsection
