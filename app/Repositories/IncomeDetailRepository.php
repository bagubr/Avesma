<?php

namespace App\Repositories;

use App\Models\IncomeDetail;

class IncomeDetailRepository {
    public static function createModel($income_id = null, $detail_pond_product_id = null, $weight = null, $price = null, $total_price = null) {
        return new IncomeDetail([
            'income_id'=>$income_id,
            'detail_pond_product_id'=>$detail_pond_product_id,
            'weight'=>$weight,
            'price'=>$price,
            'total_price'=>$total_price
        ]);
    }
}
        