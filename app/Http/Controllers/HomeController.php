<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Theme;
class HomeController extends Controller
{
    //
    public function index()
    {
        $categories = Category::withCount('themes')->get();
        $publicThemes = Theme::where('is_public', true)->latest()->take(12)->get();

        return view('home.index', compact('categories', 'publicThemes'));
    }
}
