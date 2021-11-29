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
        $ponds = Pond::where('status', '!=', Pond::STATUS1)
            ->when($request->fish_species_id, function ($query) use ($request) {
                $query->whereHas('pond_detail', function ($q) use ($request) {
                    $q->where('fish_species_id', $request->fish_species_id);
                });
            })->get();
        $this->sendSuccessResponse([
            'ponds' => PondResource::collection($ponds)
        ]);
    }
}
