window.setupQuiz = function(words, csrfToken) {
    const svg = document.getElementById("mysvg");
    const answerInput = document.getElementById("answer");
    const resultDiv = document.getElementById("result");
    const nextBtn = document.getElementById("next-btn");
    const progress = document.getElementById("progress-bar");
    const counter = document.getElementById("counter");

    let currentIndex = 0;
    let textElements = [];

    function renderProgress() {
        const percent = Math.round((currentIndex / words.length) * 100);
        progress.style.width = percent + "%";
        progress.textContent = `${percent}%`;
    }

    function renderCurrentWord() {
        svg.innerHTML = '';
        answerInput.value = '';
        resultDiv.textContent = '';
        nextBtn.classList.add('hidden');

        counter.textContent = `問題 ${currentIndex + 1} / ${words.length}`;
        renderProgress();

        const word = words[currentIndex].text;
        textElements = [];

        for (let i = 0; i < word.length; i++) {
            const t = document.createElementNS("http://www.w3.org/2000/svg", "text");
            t.setAttribute("x", 50);
            t.setAttribute("y", 110);
            t.setAttribute("font-size", 100);
            t.textContent = word[i];
            svg.appendChild(t);
            textElements.push(t);
        }
    }

    document.getElementById("remove-btn").addEventListener("click", () => {
        if (textElements.length > 0) {
            const last = textElements.shift();
            answerInput.value += last.textContent;
            svg.removeChild(last);
            postStat({ hint: true });
        }
    });

    document.getElementById("hint-btn").addEventListener("click", () => {
        showFlashCard(words[currentIndex].text);
        postStat({ flashcard: true });
    });
    

    document.getElementById("check-btn").addEventListener("click", () => {
        const correctText = words[currentIndex].text;
        const userAnswer = answerInput.value.trim();
        const correct = userAnswer === correctText;

        resultDiv.textContent = correct ? "正解！🎉" : "不正解…";
        resultDiv.style.color = correct ? 'green' : 'red';
        postStat({ play: true, correct });
        nextBtn.classList.remove('hidden');
    });

    nextBtn.addEventListener("click", () => {
        currentIndex++;
        if (currentIndex < words.length) {
            renderCurrentWord();
        } else {
            document.getElementById("quiz-area").innerHTML = `
                <h2>すべて終了！</h2>
                <p>お疲れさまでした！</p>
                <a href="/themes">← テーマ一覧へ戻る</a>
            `;
        }
    });

    function postStat(data) {
        fetch('/api/word-statistics/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({
                word_id: words[currentIndex].id,
                ...data
            })
        });
    }

    renderCurrentWord();
};

function showFlashCard(text) {
    const modalBg = document.getElementById("modal-bg");
    const modal = document.getElementById("modal");
    modal.innerHTML = "";
    modalBg.style.display = "flex";

    // カウントダウン演出（3, 2, 1）
    let count = 3;
    modal.textContent = count;
    let countdown = setInterval(() => {
      count--;
      if (count > 0) {
        modal.textContent = count;
      } else {
        clearInterval(countdown);
        // ほんの少し間を置いてから重ね文字アニメーション
        setTimeout(() => {
          // 全ての<text>を同じ位置で重ねる（SVGと同じ）
          modal.innerHTML = "";
          const svgNS = "http://www.w3.org/2000/svg";
          // SVGエレメント作成
          let tempSvg = document.createElementNS(svgNS, "svg");
          tempSvg.setAttribute("width", "200");
          tempSvg.setAttribute("height", "120");
          tempSvg.setAttribute("viewBox", "0 0 200 120");
          tempSvg.style.display = "block";
          modal.appendChild(tempSvg);

          let idx = 0;
          let interval = setInterval(() => {
            if (idx < text.length) {
              // 重ねて同じ位置に追加
              const t = document.createElementNS(svgNS, "text");
              t.setAttribute("x", 50);
              t.setAttribute("y", 90);
              t.setAttribute("font-size", 80);
              t.setAttribute("font-family", "serif");
              t.textContent = text[idx];
              tempSvg.appendChild(t);
              idx++;
            } else {
              clearInterval(interval);
              // 0.8秒後に自動で消える
              setTimeout(() => {
                modalBg.style.display = "none";
              }, 800);
            }
          }, 70); // 高速（0.07秒ごとに1文字ずつ）
        }, 300);
      }
    }, 600); // 0.6秒ごとにカウントダウン
  }
// モーダルの背景クリックで閉じる
document.addEventListener("DOMContentLoaded", () => {
    const bg = document.getElementById("modal-bg");
    if (bg) {
        bg.addEventListener("click", function (e) {
            if (e.target === this) {
                this.style.display = "none";
            }
        });
    }
});