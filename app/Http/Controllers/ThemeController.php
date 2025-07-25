<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Word;
use App\Models\WordStatistics;

class ThemeController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('theme.create', compact('categories'));
    }
    
    public function index(Request $request)
    {
        $categories = Category::all();

        $query = Theme::with(['category', 'words.wordStatistics']);
    
        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where('name', 'like', "%{$q}%")
                  ->orWhereHas('category', function ($sub) use ($q) {
                      $sub->where('name', 'like', "%{$q}%");
                  });
        }
    
        $themes = $query->get();
    
        return view('theme.index', compact('themes','categories'));
    }
    

    public function edit(Theme $theme)
    {
        $categories = Category::all();
        return view('theme.edit', compact('theme', 'categories'));
    }

    public function update(Request $request, Theme $theme)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'is_public' => 'nullable|boolean',
            'word_list' => 'nullable|string',
        ]);
    
        $theme->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'is_public' => $request->has('is_public'),
        ]);
    
        // 単語の一括追加
        if ($request->filled('word_list')) {
            $lines = preg_split('/\r\n|\r|\n/', $request->word_list);
            foreach ($lines as $line) {
                $text = trim($line);
                if ($text === '') continue;
    
                $word = Word::firstOrCreate(['text' => $text]);
                $theme->words()->syncWithoutDetaching([$word->id]);
                $word->wordStatistics()->firstOrCreate([]);
            }
        }
    
        return redirect()->route('themes.edit', $theme->id)->with('success', 'テーマを更新しました');
    }
    
    public function store(Request $request)
    {

        // カテゴリの処理
        if ($request->filled('category_name')) {
            // 新規カテゴリ名がある場合はそちらを優先
            $category = Category::firstOrCreate(['name' => $request->category_name]);
        } elseif ($request->filled('category_id')) {
            // 選択されたカテゴリを使う
            $category = Category::find($request->category_id);
        } else {
            return back()->withErrors(['category_id' => 'カテゴリを選択するか、新規作成してください']);
        }

        // テーマ作成
        $theme = Theme::create([
            'name' => $request->theme_name,
            'is_public' => $request->has('is_public'),
            'category_id' => $category->id,
        ]);
        if ($request->filled('word_list')) {
            $words = preg_split('/\r\n|\r|\n/', $request->word_list);
            foreach ($words as $wordText) {
                $wordText = trim($wordText);
                if ($wordText === '') continue;

                $word = Word::firstOrCreate(['text' => $wordText]);
                $theme->words()->attach($word->id); // 多対多
            }
        }
        return redirect()->route('themes.edit', $theme->id)->with('success', 'テーマとカテゴリを登録しました');
    }
    public function detachWord(Theme $theme, Word $word)
    {
        $theme->words()->detach($word->id);

        return back()->with('success', '単語を削除しました');
    }
}