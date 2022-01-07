<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FishPriceResource;
use App\Models\FishPrice;
use Illuminate\Http\Request;

class FishPriceController extends Controller
{
    public function index(Request $request)
    {
        $fish_prices = FishPrice::when($request->fish_species_id, function ($q) use ($request) {
            $q->where($request->fish_species_id, 'fish_species_id');
        })->get();
        return $this->sendSuccessResponse([
            'fish_prices' => FishPriceResource::collection($fish_prices),
        ]);
    }
    public function show(FishPrice $fish_price)
    {
        return $this->sendSuccessResponse([
            'fish_price' => new FishPriceResource($fish_price),
        ]);
    }
}
