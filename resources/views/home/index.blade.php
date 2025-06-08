@extends("layouts.basic")

@section("title", "日本人なら…読めるよね？重ね文字クイズ！")
@section("head")
  <meta name="description" content="日本人なら…読めるかも？重ね文字クイズ。">
@endsection

@section("content")

  <section class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
    <h2 class="text-2xl font-bold mb-3 border-b border-blue-400 pb-2">はじめに</h2>
    <p class="text-gray-700 leading-relaxed">
      このゲームは、「日本人なら読めるよね？」と言いたくなるような重ね文字に挑戦する、<strong class="text-gray-900">直感勝負のクイズ</strong>です。<br>
      パッと見て読めそうで読めない。そんな重ね文字を見抜けるか、自分の感覚を試してみましょう。<br>
      さらに、高速フラッシュカードによるヒントもあるよ！ちょっとしたスキマ時間でも楽しめます。
    </p>
  </section>

  <section class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
    <h2 class="text-2xl font-bold mb-4 border-b border-blue-400 pb-2">新着</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      @foreach($publicThemes as $theme)
        <div class="border border-blue-200 bg-gray-50 rounded-lg p-4 shadow-sm hover:shadow-md transition">
          <a href="{{ route('quiz.show', $theme->id) }}" class="block text-lg font-semibold text-gray-900 hover:text-blue-600">
            {{ $theme->name }}
          </a>
          <p class="text-sm text-gray-600 mt-1">
            カテゴリ：
            <a href="{{ route('categories.show', $theme->category->id) }}"
              class="text-blue-500 hover:underline">
              {{ $theme->category->name ?? '未設定' }}
            </a>
          </p>
        </div>
      @endforeach
    </div>
  </section>


@endsection
