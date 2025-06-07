<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Category;
use App\Models\Word;
use App\Models\WordStatistics;


class RankingController extends Controller
{

    public function ranking()
    {
        $categories = Category::all();

        $title ="平均正解率";

        $words = WordStatistics::with('word')
            ->get()
            ->map(function ($stat) {
                $stat->correct_rate = $stat->play_count > 0
                    ? round($stat->correct_count / $stat->play_count * 100, 1)
                    : null;
                return $stat;
            })
            ->sortByDesc('correct_rate');

        return view('ranking.ranking', compact('words','categories'));
    }
    public function playCount()
    {
        $categories = Category::all();

        $title ="プレイ回数";


        $words = Word::with('wordStatistics')
            ->whereHas('wordStatistics')
            ->get()
            ->sortByDesc(fn($word) => $word->wordStatistics->play_count)
            ->take(50);
        return view('ranking.index', compact('words','categories','title'));
    }

    public function correctCount()
    {

        $categories = Category::all();

        $title ="正解数";

        $words = Word::with('wordStatistics')
            ->whereHas('wordStatistics')
            ->get()
            ->sortByDesc(fn($word) => $word->wordStatistics->correct_count)
            ->take(50);

        return view('ranking.index', compact('words','categories','title'));
    }

    public function hintCount()
    {
        $title ="ヒント回数";

        $categories = Category::all();

        $words = Word::with('wordStatistics')
            ->whereHas('wordStatistics')
            ->get()
            ->sortByDesc(fn($word) => $word->wordStatistics->hint_count)
            ->take(50);

        return view('ranking.index', compact('words','categories','title'));
    }

    public function flashcardCount()
    {
        $title ="フラッシュカード利用回数";
        $categories = Category::all();

        $words = Word::with('wordStatistics')
            ->whereHas('wordStatistics')
            ->get()
            ->sortByDesc(fn($word) => $word->wordStatistics->flashcard_count)
            ->take(50);

        return view('ranking.index', compact('words','categories','title'));
    }

}
