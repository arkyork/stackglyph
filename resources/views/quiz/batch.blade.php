<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>{{ $theme->name }}｜まとめてクイズ</title>
  <style>
    #mysvg { background: #fff; display: block; margin-bottom: 1em; }
    .hidden { display: none; }
  </style>
  @vite('resources/js/quiz.js')
</head>
<body>

<body>
  <h1>テーマ「{{ $theme->name }}」のクイズ</h1>
  <div id="progress-container" style="background: #eee; width: 100%; height: 1.5em; margin-bottom: 1em;">
    <div id="progress-bar" style="background: green; width: 0%; height: 100%; color: white; text-align: center; font-size: 0.9em;"></div>
  </div>

  <div id="quiz-area">
    <p id="counter"></p>
    <svg id="mysvg" width="500" height="150"></svg>

    <div>
      <button id="remove-btn">一文字消す</button>
      <button id="hint-btn">フラッシュカード</button>
    </div>

    <div>
      <input id="answer" type="text">
      <button id="check-btn">答え合わせ</button>
    </div>

    <div id="result"></div>
    <button id="next-btn" class="hidden">次の問題へ</button>
  </div>
  <div id="modal-bg" class="modal-bg" style="display: none;
  position: fixed; top: 0; left: 0; right: 0; bottom: 0;
  background: rgba(0,0,0,0.4); align-items: center; justify-content: center; z-index: 999;">
    <div id="modal" style="
        background: #fff;
        padding: 1em 2em;
        border-radius: 16px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.3);
        font-size: 2em;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 200px;
        min-height: 100px;
    "></div>
    </div>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
        const words = @json($words);
        const csrfToken = '{{ csrf_token() }}';
        setupQuiz(words, csrfToken);
    });
  </script>
</body>


</body>
</html>
