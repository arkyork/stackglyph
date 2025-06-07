<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Theme;
use App\Models\Word;


class SitemapController extends Controller
{
    //
    public function sitemap(){

        $total = Word::count();
        $perPage = 1000;
        $pages = ceil($total / $perPage);

        return response()->view('sitemap.sitemap', [
            'pages' => $pages
        ])->header('Content-Type', 'text/xml');

    }

    public function quizSitemap(Request $request, $page = 1) {

        $xml = Theme::where("is_public",true)->get();
        return response()->view('sitemap.quiz', ["posts" => $xml])
                        ->header('Content-Type', 'text/xml');
    }
    // page=1 専用
    public function wordSitemap()
    {
        $perPage = 1000;
        $words = Word::orderBy('id')->take($perPage)->get();

        return response()->view('sitemap.word', [
            'posts' => $words
        ])->header('Content-Type', 'text/xml');
    }

    // page=2 以降
    public function wordSitemapPage($page)
    {
        $perPage = 1000;
        $offset = ($page - 1) * $perPage;

        $words = Word::orderBy('id')
                    ->skip($offset)
                    ->take($perPage)
                    ->get();
        
        if(count($words)==0){
            abort(404);
        }
        return response()->view('sitemap.word', [
            'posts' => $words
        ])->header('Content-Type', 'text/xml');
    }
}
