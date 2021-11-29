<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\PondResource;
use App\Models\Pond;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function index(Request $request)
    {
        $ponds = Pond::where('status', Pond::STATUS2)
            ->when($request->fish_name, function ($query) use ($request) {
                $query->whereHas('pond_detail.fish_species', function ($q) use ($request) {
                    $q->where('name', 'ilike', "%" . $request->fish_name . "%");
                });
            })
            ->when($request->fish_category_id, function ($query) use ($request) {
                $query->whereHas('pond_detail.fish_species', function ($q) use ($request) {
                    $q->where('fish_category_id', $request->fish_category_id);
                });
            })->get();
        $this->sendSuccessResponse([
            'ponds' => PondResource::collection($ponds)
        ]);
    }
}
