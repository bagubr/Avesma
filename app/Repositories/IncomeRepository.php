<?php

namespace App\Repositories;

use App\Models\Income;

class IncomeRepository
{
    public static function createModel($cycle_id, $reported_at)
    {
        return new Income([
            'cycle_id' => $cycle_id,
            'reported_at' => $reported_at
        ]);
    }
}
