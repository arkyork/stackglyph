let results = [];

window.setupQuiz = function(words, csrfToken) {
    const answerInput = document.getElementById("answer");
    const resultDiv = document.getElementById("result");
    const nextBtn = document.getElementById("next-btn");
    const progress = document.getElementById("progress-bar");
    const counter = document.getElementById("counter");
    const ans = JSON.parse(JSON.stringify(words));

    let hintCount       = 0;   // 1文字消した回数
    let flashcardCount  = 0;   // フラッシュカード使用回数
    let correctCount    = 0;   // 正解数
    let answerCount     = 0;   // 答え合わせボタンを押した回数

    let currentIndex = 0;
    let textElements = [];
    function renderProgress() {
        const percent = Math.round((currentIndex / words.length) * 100);
        progress.style.width = percent + "%";
        progress.textContent = `${percent}%`;
    }

    function renderCurrentWord() {
        const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
        svg.setAttribute("xmlns", "http://www.w3.org/2000/svg");
        svg.setAttribute("width", "400");
        svg.setAttribute("height", "400");
    
        const word = words[currentIndex].text;
        textElements = [];
    
        for (let i = 0; i < word.length; i++) {
            const t = document.createElementNS("http://www.w3.org/2000/svg", "text");
            t.setAttribute("x", "50%");
            t.setAttribute("y", "50%");
            t.setAttribute("text-anchor", "middle");
            t.setAttribute("dominant-baseline", "middle");
            t.setAttribute("font-size", "250"); // 大きめのサイズ
            t.textContent = word[i];
            svg.appendChild(t);
            textElements.push(t);
        }
    
        // SVG → DataURL変換
        const svgString = new XMLSerializer().serializeToString(svg);
        const encoded = encodeURIComponent(svgString);
        const dataUrl = `data:image/svg+xml;charset=utf-8,${encoded}`;
    
        // <img> に差し替え
        const img = document.createElement("img");
        img.setAttribute("src", dataUrl);
        img.setAttribute("alt", "quiz image");
        img.className = "mx-auto mb-4";
    
        const container = document.getElementById("mysvg-container");
        container.innerHTML = ''; // 前の画像を消す
        container.appendChild(img);
    
        resultDiv.textContent = '';
        nextBtn.classList.add('hidden');
        counter.textContent = `問題 ${currentIndex + 1} / ${words.length}`;
        renderProgress();
    }
    

    

    document.getElementById("remove-btn").addEventListener("click", () => {
        if (textElements.length > 0) {
            const removed = textElements.shift();
    
            // 残りの文字で再描画
            const remainingText = textElements.map(t => t.textContent).join('');
            words[currentIndex].text = remainingText;
            renderCurrentWord();
            answerInput.value += removed.textContent;
            hintCount++;
            postStat({ hint: true });
        }
    });
    
    document.getElementById("hint-btn").addEventListener("click", () => {
        showFlashCard(words[currentIndex].text);
        flashcardCount++;
        postStat({ flashcard: true });
    });
    

    document.getElementById("check-btn").addEventListener("click", () => {
        const correctText = ans[currentIndex].text;
        const userAnswer = answerInput.value.trim();
        const correct = userAnswer === correctText;
    
        resultDiv.textContent = correct ? "正解！🎉" : "不正解…";
        resultDiv.style.color = correct ? 'green' : 'red';
        
        answerCount++;
        if (correct) correctCount++;
    
        results.push({
            text: correctText,
            user: userAnswer,
            correct: correct
        });
    
        postStat({ play: true, correct });
        nextBtn.classList.remove('hidden');
    });

    nextBtn.addEventListener("click", () => {
        currentIndex++;
        remove_el()
        if (currentIndex < words.length) {
            renderCurrentWord();
            answerInput.value = "";
        } else {
            renderProgress();
    
            const percent = Math.round((correctCount / answerCount) * 100);
    
            let resultHtml = `
                <h2 class="text-xl font-bold text-center mb-6">結果発表</h2>
                <div class="space-y-2 text-lg">
                    <p>正解数：<span class="font-semibold">${correctCount}</span> / ${answerCount}（正解率 ${percent}%）</p>
                    <p>ヒント使用：<span class="font-semibold">${hintCount}</span> 回</p>
                    <p>フラッシュカード使用：<span class="font-semibold">${flashcardCount}</span> 回</p>
                </div>
    
                <h3 class="mt-6 text-lg font-semibold">出題内容と結果</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
            `;
    
            results.forEach(r => {
                // SVG生成
                const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
                svg.setAttribute("xmlns", "http://www.w3.org/2000/svg");
                svg.setAttribute("width", "200");
                svg.setAttribute("height", "100");
                svg.setAttribute("viewBox", "0 0 200 100");
    
                for (let i = 0; i < r.text.length; i++) {
                    const t = document.createElementNS("http://www.w3.org/2000/svg", "text");
                    t.setAttribute("x", "100");
                    t.setAttribute("y", "60");
                    t.setAttribute("text-anchor", "middle");
                    t.setAttribute("font-size", "60");
                    t.setAttribute("font-family", "serif");
                    t.textContent = r.text[i];
                    svg.appendChild(t);
                }
    
                const svgStr = new XMLSerializer().serializeToString(svg);
                const encoded = encodeURIComponent(svgStr);
                const imgSrc = `data:image/svg+xml;charset=utf-8,${encoded}`;
                const mark = r.correct ? '◯' : '×';
                const color = r.correct ? 'text-green-600' : 'text-red-600';
    
                resultHtml += `
                    <div class="border p-4 rounded shadow">
                        <img src="${imgSrc}" alt="重ね文字" class="mx-auto mb-2" />
                        <p class="${color} font-bold">${mark} あなたの答え：${r.user}</p>
                        <p class="text-sm text-gray-500">正解：${r.text}</p>
                    </div>
                `;
            });
    
            resultHtml += `</div>
                <div class="mt-8 text-center">
                    <a href="/" class="text-blue-600 underline">← ホームへ戻る</a>
                </div>`;
    
            document.getElementById("quiz-area").innerHTML = resultHtml;
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

// フラッシュカード
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


document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".hint-area button");
    const input = document.getElementById("answer");

    buttons.forEach(button => {
        button.addEventListener("click", () => {
        const text = button.textContent;
        // 現在の入力欄の末尾に追加する場合は以下のように
        input.value = text;

        // 入力欄をその文字列に置き換える場合は以下のように（上の行をコメントアウトしてこの行を使ってください）
        // input.value = text;

        // 入力欄にフォーカス
        input.focus();
        });
    });
});


// 要素の削除
function remove_el(){
    const buttons = document.querySelectorAll(".hint-area button");
    results.forEach(element => {
        buttons.forEach(button =>{
            if(element["text"] == button.textContent ){
                button.remove()
            }
        })

    });
}



document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.getElementById('toggleHint');
    const hintArea = document.getElementById('hintArea');
    const icon = document.getElementById('toggleIcon');
    let isOpen = false;

    toggleBtn.addEventListener('click', () => {
      isOpen = !isOpen;
      hintArea.classList.toggle('hidden', !isOpen);
      icon.classList.toggle('rotate-180', isOpen);
      toggleBtn.querySelector('span')?.remove(); // spanがあれば削除
      const label = document.createElement('span');
      label.textContent = isOpen ? 'ヒントを隠す' : 'ヒントを表示';
      toggleBtn.appendChild(label);
    });

    // 初期ラベル追加
    const initialLabel = document.createElement('span');
    initialLabel.textContent = 'ヒントを表示';
    toggleBtn.appendChild(initialLabel);
  });


  document.addEventListener("DOMContentLoaded", function () {
    const images = document.querySelectorAll("img");
    images.forEach(function (img) {
      img.addEventListener("contextmenu", function (e) {
        e.preventDefault();
      });
    });
  });

  document.addEventListener("DOMContentLoaded", function () {
    const settingsBtn = document.getElementById("settings-btn");
    const settingsModal = document.getElementById("settings-modal-bg");
    const settingsClose = document.getElementById("settings-close-btn");
  
    settingsBtn.addEventListener("click", () => {
      settingsModal.classList.remove("hidden");
      settingsModal.classList.add("flex");
    });
  
    settingsClose.addEventListener("click", () => {
      settingsModal.classList.add("hidden");
      settingsModal.classList.remove("flex");
    });
  });