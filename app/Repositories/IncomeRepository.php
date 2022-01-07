<?php

namespace App\Repositories;

use App\Models\Income;

class IncomeRepository
{
    public static function createModel($pond_detail_id, $reported_at)
    {
        return new Income([
            'pond_detail_id' => $pond_detail_id,
            'reported_at' => $reported_at
        ]);
    }
}
