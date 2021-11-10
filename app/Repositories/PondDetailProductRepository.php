<?php

namespace App\Repositories;

use App\Models\PondDetailProduct;

class PondDetailProductRepository {
    public static function get(array $filter = []) {
        return self::queryGet($filter)->get();
    }

    private static function queryGet(array $filter = []) {
        return PondDetailProduct::when(@$filter['pond_detail_id'], function($query) use ($filter) {
            $query->where('pond_detail_id', $filter['pond_detail_id']);
        })
        ->when(@$filter['name'], function($query) use ($filter) {
            $query->where('name', 'ilike', '%'.$filter['name'].'%');
        });
    }
}
        