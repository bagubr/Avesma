<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePondHarvestRequest;
use App\Models\PondHarvest;
use Illuminate\Http\Request;

class PondHarvestController extends Controller
{
    public function store(CreatePondHarvestRequest $request)
    {
        $pond_harvest = PondHarvest::updateOrCreate(
            [
                'pond_detail_id' => $request->pond_detail_id
            ],
            [
                'harvest_at' => $request->harvest_at,
                'weight' => $request->weight,
                'image' =>  $request->file('image')->store('images', ['disk' => 'public'])
            ]
        );
        return $this->sendSuccessResponse([
            'pond_harvest' => $pond_harvest
        ]);
    }
}
