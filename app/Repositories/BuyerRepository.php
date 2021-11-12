<?php

namespace App\Repositories;

use App\Models\Buyer;

class BuyerRepository {
    private static function queryGet(array $filter = []) {
        return Buyer::when(@$filter['date'], function($query) use ($filter) {
            $query->whereDate('created_at', $filter['date']);
        })
        ->when(@$filter['pond_detail_id'], function($query) use ($filter) {
            $query->where('pond_detail_id', $filter['pond_detail_id']);
        });
    }

    public static function find($id) {
        return self::queryGet([])->with('pond_detail.fish_species.fish_category')->with('pond_detail.pond.user')->find($id);
    }

    public static function get(array $filter) {
        return self::queryGet($filter)->with('pond_detail.fish_species.fish_category')
            ->with('pond_detail.pond.user')
            ->select(
                'id',
                'pond_detail_id',
                'name',
                'phone',
                'status'
            )->get();
    } 

}
        