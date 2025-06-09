@extends('layouts.basic')

@section('title', '遊び方 - 重ね文字あてゲーム')

@section('content')
<div class="mx-auto p-6 bg-white rounded-lg shadow">

  <h1 class="text-3xl font-bold text-center text-blue-800">🎮 遊び方ガイド</h1>

  <section class="space-y-4 mb-4">
    <h2 class="text-xl font-semibold text-gray-800 border-l-4 border-blue-400 pl-3">🔤 重ね文字って？</h2>
    <p class="text-gray-700 leading-relaxed">
      「重ね文字」とは、複数の文字を同じ場所に重ねて表示し、元の単語を読み取るゲームです。<br>
      例えるなら、<strong>透明な文字を重ねて1つの謎の文字に見える</strong>ような感覚です。
    </p>
  </section>

  <section class="space-y-4 mb-4">
    <h2 class="text-xl font-semibold text-gray-800 border-l-4 border-blue-400 pl-3">📚 遊び方の流れ</h2>
    <ol class="list-decimal list-inside text-gray-700 space-y-1">
      <li>画面中央に重ねられた文字画像が表示されます。</li>
      <li>「フラッシュカード」ボタンを押すと、フラッシュカードで表示されます。</li>
      <li>「一文字消す」ボタンを押すと、重なっている文字が1つずつ減っていきます。</li>
      <li>答えがわかったら、入力欄に単語を入力して「答え合わせ」ボタンを押してください。</li>
      <li>正解すると「次の問題へ」ボタンが表示され、次の問題に進めます。</li>
    </ol>
  </section>

  <section class="space-y-4 mb-4">
    <h2 class="text-xl font-semibold text-gray-800 border-l-4 border-blue-400 pl-3">💡 コツ</h2>
    <ul class="list-disc list-inside text-gray-700 space-y-1">
      <li>同じ位置に違う文字が重なって見えることがあります。</li>
      <li>ぼんやり見て、パターンや形の違和感に注目してみましょう。</li>
      <li>1文字ずつ消していくと、見え方が変わるのでヒントになります！</li>
    </ul>
  </section>

  <div class="text-center mt-10">
    <a href="{{ route('home') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-full shadow hover:bg-blue-700 transition">
      ゲームを始める
    </a>
  </div>

</div>
@endsection
