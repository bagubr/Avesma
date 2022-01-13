<?php

namespace App\Services;

use App\Models\Income;
use App\Models\IncomeDetail;

class IncomeService
{
    public static function create(Income $income, array $income_details)
    {
        $income->save();
        $income->refresh();
        foreach ($income_details as $i) {
            IncomeDetail::create(array_merge([
                'income_id' => $income->id
            ], $i));
        }

        return $income;
    }
}
