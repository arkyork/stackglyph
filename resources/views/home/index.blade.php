<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>日本人なら…読めるよね？重ね文字クイズ！</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @vite("resources/css/app.css")
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

  <header class="bg-slate-800 text-white p-6 shadow-md">
    <div class="max-w-4xl mx-auto">
      <h1 class="text-2xl font-bold text-center">重ね文字あてゲーム</h1>
      <nav class="mt-4 flex justify-center gap-6 text-sm">
        <a href="{{ route('categories.index') }}" class="hover:text-yellow-300 transition">カテゴリ</a>
        <a href="{{ route('ranking') }}" class="hover:text-yellow-300 transition">ランキング</a>
        <a href="{{ route('themes.index') }}" class="hover:text-yellow-300 transition">テーマ管理</a>
      </nav>
    </div>
  </header>

  <main class="max-w-4xl mx-auto py-10 px-4 space-y-10">
    <section class="bg-white rounded-2xl p-6 shadow-md">
    <h2 class="text-xl font-semibold mb-3 border-b-2 border-slate-300 pb-1">はじめに</h2>
    <p class="text-gray-700 leading-relaxed">
        このゲームは、「日本人なら読めるよね？」と言いたくなるような重ね文字に挑戦する、<strong>直感勝負のクイズ</strong>です。<br>
        パッと見て読めそうで読めない。そんな重ね文字を見抜けるか、自分の感覚を試してみましょう。<br>
        さらに、高速フラッシュカードによるヒントもあるよ！ちょっとしたスキマ時間でも楽しめます。
    </p>
    </section>
    <section class="bg-white rounded-2xl p-6 shadow-md">
      <h2 class="text-xl font-semibold mb-4">カテゴリ一覧</h2>
      <ul class="space-y-2">
        @foreach($categories as $category)
          <li>
            <a href="{{ route('categories.show', $category->id) }}" class="block p-3 rounded-lg bg-slate-100 hover:bg-slate-200 transition">
              {{ $category->name }}（{{ $category->themes_count }}テーマ）
            </a>
          </li>
        @endforeach
      </ul>
    </section>

    <section class="bg-white rounded-2xl p-6 shadow-md">
      <h2 class="text-xl font-semibold mb-4">新着公開テーマ</h2>
      <ul class="space-y-3">
        @foreach($publicThemes as $theme)
          <li class="border-l-4 border-blue-400 pl-4">
            <div class="flex justify-between items-center">
              <div>
                <strong class="text-gray-800">{{ $theme->name }}</strong>
                <span class="text-sm text-gray-500">（カテゴリ: {{ $theme->category->name ?? '未設定' }}）</span>
              </div>
              <a href="{{ route('quiz.show', $theme->id) }}" class="text-blue-600 hover:underline text-sm">▶ クイズ</a>
            </div>
          </li>
        @endforeach
      </ul>
    </section>
  </main>

  <footer class="bg-slate-800 text-white text-center text-sm py-4">
    &copy; {{ date('Y') }} KasaneMoji Game
  </footer>

</body>
</html>
