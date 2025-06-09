<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;


class PostController extends Controller
{
    //
    public function howto() {
        $categories = Category::all();
        return view('single.howto',compact('categories'));
    }
    public function policy() {
        $categories = Category::all();
        return view('single.policy',compact('categories'));
    }
    
}
