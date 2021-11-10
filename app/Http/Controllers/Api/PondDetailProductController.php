<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PondDetailProduct;
use App\Repositories\PondDetailProductRepository;
use Illuminate\Http\Request;

class PondDetailProductController extends Controller
{
    public function index(Request $request) {
        return $this->sendSuccessResponse([
            'products'=>PondDetailProductRepository::get($request->toArray())
        ]);
    }

    public function store(Request $request) {
        $pond_detail_product = PondDetailProduct::create([
            'pond_detail_id'=>$request->pond_detail_id,
            'name'=>$request->name
        ]);

        return $this->sendSuccessResponse([
            'product'=>$pond_detail_product
        ]);
    }
}
