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
        $query = Theme::with(['category', 'words.wordStatistics']);
    
        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where('name', 'like', "%{$q}%")
                  ->orWhereHas('category', function ($sub) use ($q) {
                      $sub->where('name', 'like', "%{$q}%");
                  });
        }
    
        $themes = $query->get();
    
        return view('theme.index', compact('themes'));
    }
    
    public function ranking()
    {
        $words = WordStatistics::with('word')
            ->get()
            ->map(function ($stat) {
                $stat->correct_rate = $stat->play_count > 0
                    ? round($stat->correct_count / $stat->play_count * 100, 1)
                    : null;
                return $stat;
            })
            ->sortByDesc('correct_rate');

        return view('theme.ranking', compact('words'));
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

        // カテゴリがなければ作成
        $category = Category::firstOrCreate(['name' => $request->category_name]);

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