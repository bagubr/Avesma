<?php

namespace App\Repositories;

use App\Models\IncomeDetail;

class IncomeDetailRepository {
    public static function createModel($income_id = null, $name = null, $weight = null, $price = null, $total_price = null) {
        return new IncomeDetail([
            'income_id'=>$income_id,
            'name'=>$name,
            'weight'=>$weight,
            'price'=>$price,
            'total_price'=>$total_price
        ]);
    }
}
        