<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return $this->sendSuccessResponse([
            'articles' => $articles,
        ]);
    }
    public function show($id)
    {
        $article = Article::find($id);
        return $this->sendSuccessResponse([
            'article' => $article,
        ]);
    }
}
