<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PondDetailProduct\CreatePondDetailProductRequest;
use App\Http\Requests\UpdatePondDetailProductRequest;
use App\Models\PondDetailProduct;
use App\Repositories\PondDetailProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PondDetailProductController extends Controller
{
    public function index(Request $request)
    {
        return $this->sendSuccessResponse([
            'products' => PondDetailProductRepository::get($request->toArray())
        ]);
    }
    public function show(PondDetailProduct $pond_detail_product)
    {
        return $this->sendSuccessResponse([
            'product' => $pond_detail_product,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'pond_detail_id' => 'required',
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendFailedResponse(['errors' => $validator->errors()]);
        }

        $pond_detail_product = PondDetailProduct::create($data);
        return $this->sendSuccessResponse([
            'product' => $pond_detail_product
        ], 'Produk Anda Berhasil Ditambahkan');
    }

    public function update(UpdatePondDetailProductRequest $request, PondDetailProduct $pond_detail_product)
    {
        $data = $request->all();
        $pond_detail_product->update($data);
        return $this->sendSuccessResponse([
            'product' => $pond_detail_product
        ], 'Produk Anda Berhasil Diubah');
    }

    public function destroy(PondDetailProduct $pond_detail_product)
    {
        $pond_detail_product->delete();
        return $this->sendSuccessResponse([
            'product' => $pond_detail_product
        ], 'Produk Anda Berhasil Dihapus');
    }
}
