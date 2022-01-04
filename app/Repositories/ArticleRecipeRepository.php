<?php

namespace App\Repositories;

use App\Models\ArticleRecipe;
use GuzzleHttp\Psr7\Request;

class ArticleRecipeRepository {
    private static function queryGet(array $filter = []) {
        return ArticleRecipe::when(@$filter['title'], function($query) use ($filter) {
            $query->where('title', 'ilike', '%'.$filter['title'].'%');
        });
    }

    public static function get(array $filter = []) {
        return self::queryGet($filter)->get();
    }

    public static function find($id) {
        return self::queryGet()->find($id);
    }
}
        