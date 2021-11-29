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
        $article = Article::find($request->get('id'));
        $url = 'intent://view?id=123#Intent;package=com.cancreative.avesma;scheme=http;launchFlags=268435456;end;';
        return view('share', compact('url', 'article', 'site'));
    }
}
