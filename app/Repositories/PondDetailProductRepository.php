<?php

namespace App\Repositories;

use App\Models\PondDetailProduct;

class PondDetailProductRepository {
    public static function get(array $filter = []) {
        return self::queryGet($filter)->get();
    }

    private static function queryGet(array $filter = []) {
        return PondDetailProduct::when(@$filter['cycle_id'], function($query) use ($filter) {
            $query->where('cycle_id', $filter['cycle_id']);
        })
        ->when(@$filter['name'], function($query) use ($filter) {
            $query->where('name', 'ilike', '%'.$filter['name'].'%');
        });
    }
}
        