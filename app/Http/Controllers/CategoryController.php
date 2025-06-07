<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function index()
    {

        $categories = Category::withCount('themes')->get();
        return view('category.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $categories = Category::all();

        if(auth()){
            $themes = $category->themes()->withCount('words')->get();

        }else{
            $themes = $category->themes()->where('is_public', true)->withCount('words')->get();
        }
        return view('category.show', compact('category', 'themes','categories'));
    }
}
