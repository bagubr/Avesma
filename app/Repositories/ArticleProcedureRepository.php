<?php

namespace App\Repositories;

use App\Models\ArticleProcedure;

class ArticleProcedureRepository {
    private static function queryGet(array $filter = []) {
        return ArticleProcedure::when(@$filter['procedure_id'], function($query) use ($filter) {
            $query->where('procedure_id', $filter['procedure_id']);
        });  
    }

    public static function get(array $filter = []) {
        return self::queryGet($filter)->get();
    }

    public static function find($id) {
        return self::queryGet([
            'id'=>$id
        ])->find($id);
    }
}
        