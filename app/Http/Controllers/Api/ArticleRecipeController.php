<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleRecipeResource;
use App\Models\ArticleRecipe;
use App\Repositories\ArticleRecipeRepository;
use Illuminate\Http\Request;

class ArticleRecipeController extends Controller
{
    public function index(Request $request)
    {
        return $this->sendSuccessResponse([
            'article_recipes' => ArticleRecipeResource::collection(ArticleRecipeRepository::get())
        ]);
    }

    public function show(Request $request, $id)
    {
        return $this->sendSuccessResponse([
            'article_recipe' => new ArticleRecipeResource(ArticleRecipeRepository::find($id))
        ]);
    }
}
