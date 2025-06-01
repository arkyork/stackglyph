<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'is_public'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function words()
{
    return $this->belongsToMany(Word::class, 'theme_word')->withTimestamps();
}
}
