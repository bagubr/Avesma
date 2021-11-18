<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PondDetailProduct\CreatePondDetailProductRequest;
use App\Models\PondDetailProduct;
use App\Repositories\PondDetailProductRepository;
use Illuminate\Http\Request;

class PondDetailProductController extends Controller
{
    public function index(Request $request)
    {
        return $this->sendSuccessResponse([
            'products' => PondDetailProductRepository::get($request->toArray())
        ]);
    }

    public function store(CreatePondDetailProductRequest $request)
    {
        $data = $request->all();
        $pond_detail_product = PondDetailProduct::create($data);
        return $this->sendSuccessResponse([
            'product' => $pond_detail_product
        ]);
    }
}
