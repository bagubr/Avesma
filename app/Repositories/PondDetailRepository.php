<?php

namespace App\Repositories;

use App\Models\PondDetail;

class PondDetailRepository
{
    public static function createModel($fish_species_id = null, $seed_count = null): PondDetail
    {
        return new PondDetail([
            'fish_species_id' => $fish_species_id,
            'seed_count' => $seed_count,
        ]);
    }
}
