<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleProcedure;
use App\Models\ArticleRecipe;
use App\Models\Disclaimer;
use App\Models\FishCategory;
use App\Models\Slider;
use App\Services\UserService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        UserService::updateFcmToken($request->user(), $request->fcm_token);
        $sliders = Slider::inRandomOrder()->get();
        $fish_categories = FishCategory::all();
        $articles = Article::inRandomOrder()->limit(10)->get();
        $article_recipes = ArticleRecipe::inRandomOrder()->limit(10)->get();
        $article_procedures = ArticleProcedure::inRandomOrder()->limit(10)->get();
        $disclaimer = Disclaimer::first();

        return $this->sendSuccessResponse([
            'sliders' => $sliders,
            'fish_categories' => $fish_categories,
            'articles' => $articles,
            'article_recipes' => $article_recipes,
            'article_procedures' => $article_procedures,
            'disclaimer' => $disclaimer,
        ]);
    }
}
