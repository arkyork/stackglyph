<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;


class PostController extends Controller
{
    //
    public function howto() {
        $categories = Category::all();
        return view('howto',compact('categories'));
    }
}
