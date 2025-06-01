<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Word;

class WordController extends Controller
{
    //
    public function show(Word $word)
    {
        $word->load([
            'themes.category',
            'wordStatistics',
        ]);

        return view('word.show', compact('word'));
    }
}
