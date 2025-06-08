@extends('layouts.basic')

@section('title',  "ランダム重ね文字 - 日本人なら…読めるよね？重ね文字クイズ！")

@section('head')
  @vite('resources/js/quiz.js')
  <script>
    document.addEventListener("DOMContentLoaded", function() {
        const words = @json($words);
        const csrfToken = '{{ csrf_token() }}';
        setupQuiz(words, csrfToken);
    });
  </script>
  <meta name="description" content="ランダム重ね文字クイズ。日本人なら…読めるかも？">

  @if(request()->query()) 
    <meta name="robots" content="noindex, follow">
  @endif

@endsection

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8 space-y-6">

  <h1 class="text-3xl font-bold text-center">ランダム重ね文字</h1>

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
      <button id="settings-btn" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition flex items-center gap-1">
            ⚙ <span class="hidden sm:inline">設定</span>
        </button>
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
    @foreach($words as $w)
      <button class="px-4 py-2 bg-gradient-to-r from-slate-200 to-slate-300 text-slate-800 hover:from-slate-500 hover:to-slate-600 hover:text-white transition-all duration-200 ease-in-out rounded-xl shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-400">{{$w->text}}</button>
    @endforeach
  </div>

</div>


  </div>

  <!-- モーダル -->
  <div id="modal-bg" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div id="modal" class="bg-white p-8 rounded-2xl shadow-xl text-4xl min-w-[200px] min-h-[100px] flex items-center justify-center"></div>
  </div>
  @auth
  <div class="text-center mt-6">
    <button id="download-btn"
      class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
      PNGとしてダウンロード
    </button>
  </div>
  <script>
  document.getElementById("download-btn").addEventListener("click", function () {
    const img = document.querySelector("#mysvg-container img");
    if (!img) {
      alert("画像が見つかりません。");
      return;
    }

    const canvas = document.createElement("canvas");
    const ctx = canvas.getContext("2d");

    const downloadImage = new Image();
    downloadImage.crossOrigin = "anonymous";

    downloadImage.onload = function () {
      const width = downloadImage.width || 400;
      const height = downloadImage.height || 400;
      canvas.width = width;
      canvas.height = height;

      // ❌ 背景白の塗りつぶしを削除
      // ctx.fillStyle = "white";
      // ctx.fillRect(0, 0, canvas.width, canvas.height);

      // ✅ SVGをそのまま描画（背景は透過）
      ctx.drawImage(downloadImage, 0, 0);

      const pngUrl = canvas.toDataURL("image/png");
      const a = document.createElement("a");
      a.href = pngUrl;
      a.download = "quiz-image.png";
      document.body.appendChild(a);
      a.click();
      document.body.removeChild(a);
    };

    downloadImage.src = img.src;
  });
    </script>
  @endauth

</div>

<!-- 設定モーダル -->
<div id="settings-modal-bg" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
  <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative">
    <h2 class="text-xl font-bold mb-4 text-center text-gray-800">⚙ 出題数を設定</h2>

    <form method="GET" action="{{ route('quiz.random') }}" class="flex flex-col items-center gap-4">
      <label for="count" class="text-gray-700 font-medium">出題数：</label>
      <select name="count" id="count" class="border rounded px-4 py-2 w-40 text-center">
        @foreach([5, 10, 20, 50, 100] as $c)
          <option value="{{ $c }}" {{ request('count', 100) == $c ? 'selected' : '' }}>{{ $c }} 問</option>
        @endforeach
      </select>

      <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">開始する</button>
    </form>

    <div class="mt-6 text-center">
      <button id="settings-close-btn" type="button" class="text-sm text-gray-500 hover:underline">閉じる</button>
    </div>
  </div>
</div>

@endsection
