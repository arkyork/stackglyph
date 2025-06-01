<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Word extends Model
{
    //
    use HasFactory;

    protected $fillable = ['text'];

    public function themes()
    {
        return $this->belongsToMany(Theme::class, 'theme_word')->withTimestamps();
    }
    public function wordStatistics()
    {
        return $this->hasOne(WordStatistics::class);
    }
}
