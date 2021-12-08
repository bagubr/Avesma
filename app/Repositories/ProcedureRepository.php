<?php

namespace App\Repositories;

use App\Http\Resources\ProcedureResource;
use App\Http\Resources\ProcedureResourceFishSpecies;
use App\Models\Procedure;

class ProcedureRepository
{
    private static function queryGet(array $filter)
    {
        return Procedure::when(@$filter['fish_species_id'], function ($query) use ($filter) {
            $query->whereHas('form_procedures', function ($q) use ($filter) {
                $q->where('fish_species_id', $filter['fish_species_id']);
            });
        })->orderBy('id');
    }

    public static function get()
    {
        return ProcedureResource::collection(Procedure::orderBy('id')->get());
    }
    public static function search(array $filter = [])
    {
        return ProcedureResourceFishSpecies::collection(self::queryGet($filter)->get());
    }
}
