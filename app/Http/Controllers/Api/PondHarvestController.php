<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePondHarvestRequest;
use App\Models\PondHarvest;
use Illuminate\Http\Request;
use ReflectionClass;

class PondHarvestController extends Controller
{
    public function statuses()
    {
        $filter = array_filter((new ReflectionClass(PondHarvest::class))->getConstants(), function ($i, $x) {
            if (str_contains($x, "STATUS")) return true;
        }, ARRAY_FILTER_USE_BOTH);
        $filter = array_values($filter);
        return $this->sendSuccessResponse([
            'statuses' => $filter
        ]);
    }
    // public function index()
    // {
    //     $pond_harvests = PondHarvest
    // }
    public function store(CreatePondHarvestRequest $request)
    {
        $pond_harvest = PondHarvest::updateOrCreate(
            [
                'pond_detail_id' => $request->pond_detail_id
            ],
            [
                'harvest_at' => $request->harvest_at,
                'status' => PondHarvest::STATUS1,
                'weight' => $request->weight,
                'image' =>  $request->file('image')->store('images', ['disk' => 'public'])
            ]
        );
        return $this->sendSuccessResponse([
            'pond_harvest' => $pond_harvest
        ]);
    }
}
