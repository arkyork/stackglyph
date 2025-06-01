<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WordStatistics extends Model
{
    use HasFactory;

    protected $fillable = [
        'word_id',
        'play_count',
        'correct_count',
        'hint_count',
        'flashcard_count',
    ];

    public function word()
    {
        return $this->belongsTo(Word::class);
    }
}