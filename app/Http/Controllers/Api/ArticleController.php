<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return $this->sendSuccessResponse([
            'articles' => ArticleResource::collection($articles),
        ]);
    }
    public function show($id)
    {
        $article = Article::find($id);
        return $this->sendSuccessResponse([
            'article' => new ArticleResource($article),
        ]);
    }
}
