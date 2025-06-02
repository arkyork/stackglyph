<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Theme;
use App\Models\Word;


class SitemapController extends Controller
{
    //
    public function sitemap(){

        return response()->view('sitemap.sitemap')
                         ->header('Content-Type', 'text/xml');
    }

    public function quizSitemap(Request $request, $page = 1) {

        $xml = Theme::where("is_public",true)->get();
        return response()->view('sitemap.quiz', ["posts" => $xml])
                        ->header('Content-Type', 'text/xml');
    }
    public function wordSitemap(){

        $xml = Word::all();
        return response()->view('sitemap.word', ["posts" => $xml])
                        ->header('Content-Type', 'text/xml');
    }
}
