<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ArticleRecipe;
use App\Repositories\ArticleRecipeRepository;
use Illuminate\Http\Request;

class ArticleRecipeController extends Controller {
    public function index(Request $request) {
        return $this->sendSuccessResponse([
            'article_recipes'=>ArticleRecipeRepository::get()
        ]);
    }

    public function show(Request $request, $id) {
        return $this->sendSuccessResponse([
            'article_recipe'=>ArticleRecipeRepository::find($id)
        ]);
    }
}
