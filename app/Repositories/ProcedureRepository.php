<?php

namespace App\Repositories;

use App\Http\Resources\ProcedureResource;
use App\Models\Procedure;

class ProcedureRepository {
    private static function queryGet(array $filter) {
        return Procedure::when(@$filter['fish_species_id'], function($query) use ($filter) {
            $query->whereHas('form_procedures', function($q) use ($filter) {
                $q->where('fish_species_id', $filter['fish_species_id']);
            });
        })
        ->when(@$filter['title'], function($query) use ($filter) {
            $query->where('title', 'ilike', '%'.$filter['title'].'%');
        });
    }

    public static function get(array $filter = []) {
        return ProcedureResource::collection(self::queryGet($filter)->get());
    }
}
        