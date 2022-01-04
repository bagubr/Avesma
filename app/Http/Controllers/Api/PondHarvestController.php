<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePondHarvestRequest;
use App\Http\Requests\UpdateStatusPondHarvestRequest;
use App\Models\PondHarvest;
use Illuminate\Http\Request;
use ReflectionClass;

class PondHarvestController extends Controller
{
    public function statuses()
    {
        return $this->sendSuccessResponse([
            'statuses' => [
                PondHarvest::STATUS1,
                PondHarvest::STATUS2,
            ]
        ]);
    }
    public function index(Request $request)
    {
        $pond_harvests = PondHarvest::with('pond_detail.pond')->where('pond_detail_id', $request->pond_detail_id)
            ->orderBy('harvest_at', 'desc')->get();
        if (empty($request->pond_detail_id)) {
            $this->sendFailedResponse([], 'Maaf, sepertinya anda harus memilih detail kolam terlebih dahulu');
        }
        return $this->sendSuccessResponse([
            'pond_harvests' => $pond_harvests
        ]);
    }
    public function show(PondHarvest $pond_harvest)
    {
        return $this->sendSuccessResponse([
            'pond_harvest' => $pond_harvest->load('pond_detail.pond')
        ]);
    }
    public function store(CreatePondHarvestRequest $request)
    {
        $pond_harvest = PondHarvest::create(
            [
                'pond_detail_id' => $request->pond_detail_id,
                'harvest_at' => $request->harvest_at,
                'status' => PondHarvest::STATUS1,
                'description' => $request->description,
                'weight' => $request->weight,
                'image' =>  $request->file('image')->store('images', ['disk' => 'public'])
            ]
        );
        return $this->sendSuccessResponse([
            'pond_harvest' => $pond_harvest
        ], 'Panen Anda Berhasil Tersimpan');
    }
    public function update_status(UpdateStatusPondHarvestRequest $request, PondHarvest $pond_harvest)
    {
        $data = $request->all();
        $pond_harvest->update($data);
        return $this->sendSuccessResponse([
            'pond_harvest' => $pond_harvest
        ]);
    }
}
