@extends("layouts.basic")

@section("title", "日本人なら…読めるよね？重ね文字クイズ！")
@section("head")
  <meta name="description" content="日本人なら…読めるかも？重ね文字クイズ。">
@endsection

@section("content")

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
          <a href="{{ route('categories.show', $category->id) }}"
             class="block p-3 rounded-lg bg-slate-100 hover:bg-slate-200 transition">
            {{ $category->name }}
          </a>
        </li>
      @endforeach
    </ul>
  </section>

  <section class="bg-white rounded-2xl p-6 shadow-md">
    <h2 class="text-xl font-semibold mb-4">新着</h2>
    <ul class="space-y-3">
      @foreach($publicThemes as $theme)
        <li class="border-l-4 border-blue-400 pl-4">
          <div class="flex justify-between items-center">
            <div>
              <strong class="text-gray-800">{{ $theme->name }}</strong>
              <span class="text-sm text-gray-500">（<a href="{{route('categories.show',$theme->category->id)}}">{{ $theme->category->name ?? '未設定' }}</a>）</span>
            </div>
            <a href="{{ route('quiz.show', $theme->id) }}"
               class="text-blue-600 hover:underline text-sm">▶ クイズ</a>
          </div>
        </li>
      @endforeach
    </ul>
  </section>

@endsection
