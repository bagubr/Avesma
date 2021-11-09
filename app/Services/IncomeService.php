<?php

namespace App\Services;

use App\Models\Income;
use App\Models\IncomeDetail;

class IncomeService {
    public static function create(Income $income, IncomeDetail $income_detail) {
        $income->save();
        $income->refresh();
        $income_detail->income_id = $income->id;
        $income_detail->save();

        return [$income, $income_detail];
    }
}
        