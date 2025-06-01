<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>単語あてクイズ</title>
  <style>
    #mysvg { background: #fff; display: block; margin-bottom: 1em; }
    .modal-bg {
      display: none;
      position: fixed;
      left: 0; top: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,0.3);
      align-items: center;
      justify-content: center;
    }
    .modal {
      background: #fff;
      font-size: 2em;
      padding: 2em;
    }
  </style>
</head>
<body>
  <h1>この重ね文字は何？</h1>
  <svg id="mysvg" width="500" height="150"></svg>

  <button id="remove-btn">一文字消す</button>
  <button id="hint-btn">ヒント</button>

  <div>
    <input id="answer" type="text" placeholder="答えを入力">
    <button id="check-btn">答え合わせ</button>
  </div>

  <div id="result"></div>

  <div id="modal-bg" class="modal-bg">
    <div class="modal" id="modal"></div>
  </div>

  <script>
    const answerText = @json($word->text);
    const wordId = @json($word->id);
    const svg = document.getElementById("mysvg");
    const textElements = [];

    // 重ね文字表示
    for (let i = 0; i < answerText.length; i++) {
      const t = document.createElementNS("http://www.w3.org/2000/svg", "text");
      t.setAttribute("x", 50);
      t.setAttribute("y", 110);
      t.setAttribute("font-size", 100);
      t.textContent = answerText[i];
      svg.appendChild(t);
      textElements.push(t);
    }

    // 一文字ずつ削除（ヒント）
    document.getElementById("remove-btn").addEventListener("click", () => {
      if (textElements.length > 0) {
        const last = textElements.shift();
        document.getElementById("answer").value += last.textContent;
        svg.removeChild(last);

        fetch('/api/word-statistics/update', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
          },
          body: JSON.stringify({
            word_id: wordId,
            hint: true
          })
        });
      }
    });

    // フラッシュカード演出（モーダル）
    document.getElementById("hint-btn").addEventListener("click", () => {
      document.getElementById("modal-bg").style.display = "flex";
      document.getElementById("modal").textContent = answerText;

      fetch('/api/word-statistics/update', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: JSON.stringify({
          word_id: wordId,
          flashcard: true
        })
      });

      setTimeout(() => {
        document.getElementById("modal-bg").style.display = "none";
      }, 800);
    });

    // 答え合わせ
    document.getElementById("check-btn").addEventListener("click", () => {
      const userAnswer = document.getElementById("answer").value.trim();
      const result = document.getElementById("result");

      const correct = (userAnswer === answerText);
      result.textContent = correct ? "正解！🎉" : "不正解…";

      fetch('/api/word-statistics/update', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: JSON.stringify({
          word_id: wordId,
          play: true,
          correct: correct
        })
      });
    });
  </script>
</body>
</html>
