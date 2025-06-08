<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;
use App\Models\Theme;
use App\Models\Category;

class QuizController extends Controller
{
    public function randomShow(Request $request)
    {
        $input = (int) $request->input('count', 100);
        $count = null;
    
        switch ($input) {
            case 5:
            case 10:
            case 20:
            case 50:
            case 100:
                $count = $input;
                break;
            default:
                abort(404, '指定された出題数は無効です');
        }
    
        $words = Word::inRandomOrder()->limit($count)->get();
        $categories = Category::all();
    
        return view('quiz.random', [
            'words' => $words,
            'categories' => $categories,
        ]);
    }
    
    public function show(Request $request,Theme $theme)
    {
        $input = (int) $request->input('count', 10);
        $count = null;
    
        switch ($input) {
            case 5:
            case 10:
            case 20:
            case 50:
            case 100:
                $count = $input;
                break;
            default:
                abort(404, '指定された出題数は無効です');
        }

        $categories = Category::all();

        $words = $theme->words()->inRandomOrder()->with('wordStatistics')->limit($count)->get();
    
        if ($words->isEmpty()) {
            abort(404);
        }
    
        return view('quiz.batch', [
            'theme' => $theme,
            'words' => $words,
            'categories' => $categories
        ]);
    }
}
