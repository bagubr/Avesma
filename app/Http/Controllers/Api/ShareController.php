<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleProcedure;
use App\Models\ArticleRecipe;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function index(Request $request)
    {
        $site = env('APP_NAME');
        if($request->get('type') == 'article'){
            $article = Article::findOrFail($request->get('id'));
        }elseif($request->get('type') == 'article-recipe'){
            $article = ArticleRecipe::findOrFail($request->get('id'));
        }elseif($request->get('type') == 'article-procedure'){
            $article = ArticleProcedure::findOrFail($request->get('id'));
        }
        $url = 'https://play.google.com/store/apps/details?id=com.cancreative.avesma';
        return view('share', compact('url', 'article', 'site'));
    }
}
