<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WordStatistics;

class WordStatisticsController extends Controller
{

    public function update(Request $request)
    {
        $request->validate([
            'word_id' => 'required|exists:words,id',
        ]);

        $stats = WordStatistics::firstOrCreate(['word_id' => $request->word_id]);

        if ($request->has('play')) {
            $stats->increment('play_count');
        }

        if ($request->has('correct') && $request->boolean('correct')) {
            $stats->increment('correct_count');
        }

        if ($request->has('hint')) {
            $stats->increment('hint_count');
        }

        if ($request->has('flashcard')) {
            $stats->increment('flashcard_count');
        }

        return response()->json(['status' => 'ok']);
    }
}
