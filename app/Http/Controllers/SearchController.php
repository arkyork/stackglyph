<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Theme;
use App\Models\Word;


class SearchController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = $request->input('q');
        $categoryId = $request->input('category');

        $themes = Theme::with('category')
            ->when($query, fn($q) => $q->where('name', 'like', "%{$query}%"))
            ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
            ->get();

        $words = Word::with('themes')
            ->when($query, fn($q) => $q->where('text', 'like', "%{$query}%"))
            ->get();

        $categories = \App\Models\Category::all();

        return view('search.index', compact('themes', 'words', 'categories', 'query', 'categoryId'));
    }
}
