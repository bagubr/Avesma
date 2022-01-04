<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleCategoryController extends Controller
{
    public function index(Request $request) {
        $this->sendSuccessResponse([
            'article_categories'=>ArticleCategory::when($request->name, function($query) use ($request) {
                $query->where('name', 'ilike', '%'.$request->name.'%');
            })->get()
        ]);
    }
}
