<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Word;
use App\Models\Category;

class WordController extends Controller
{
    //
    public function show(Word $word)
    {
        $categories = Category::all();

        $word->load([
            'themes.category',
            'wordStatistics',
        ]);

        return view('word.show', compact('word','categories'));
    }
}
