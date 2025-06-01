@extends('layouts.basic')

@section('title', 'テーマ編集：' . $theme->name)

@section('content')
<main class="max-w-3xl mx-auto px-4 py-10 space-y-10">

  <h1 class="text-2xl font-bold text-center">テーマ編集：{{ $theme->name }}</h1>
  <div class="text-center">
    <a href="{{ route('themes.index') }}" class="text-blue-600 hover:underline">← 一覧に戻る</a>
  </div>

  <!-- 編集フォーム -->
  <form method="POST" action="{{ route('themes.update', $theme->id) }}" class="bg-white shadow-md rounded-xl p-6 space-y-6">
    @csrf

    <div>
      <label class="block font-semibold mb-1">テーマ名：</label>
      <input type="text" name="name" value="{{ old('name', $theme->name) }}"
             class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
      <label class="block font-semibold mb-1">カテゴリ：</label>
      <select name="category_id" class="w-full border rounded px-3 py-2" required>
        @foreach($categories as $category)
          <option value="{{ $category->id }}" {{ $theme->category_id == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="flex items-center gap-2">
      <input type="checkbox" name="is_public" value="1" {{ $theme->is_public ? 'checked' : '' }}
             class="w-5 h-5">
      <label class="font-semibold">公開する</label>
    </div>

    <div>
      <label class="block font-semibold mb-1">単語の一括追加</label>
      <p class="text-sm text-gray-600 mb-2">改行区切りで入力してください</p>
      <textarea name="word_list" rows="6" class="w-full border rounded px-3 py-2"
                placeholder="例：&#10;従量課金&#10;仮想化&#10;クラウド"></textarea>
    </div>

    <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
      保存
    </button>
  </form>

  <!-- 登録済み単語一覧 -->
  <section>
    <h2 class="text-xl font-semibold mb-4">登録単語一覧</h2>

    @if ($theme->words->isEmpty())
      <p class="text-gray-500">まだ単語がありません。</p>
    @else
      <ul class="space-y-3">
        @foreach($theme->words as $word)
          <li class="bg-white rounded-lg shadow flex justify-between items-center px-4 py-2">
            <span>{{ $word->text }}</span>
            <form action="{{ route('themes.word.detach', [$theme->id, $word->id]) }}" method="POST" onsubmit="return confirm('削除してよいですか？')">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-600 hover:underline text-sm">削除</button>
            </form>
          </li>
        @endforeach
      </ul>
    @endif
  </section>

</main>
@endsection
