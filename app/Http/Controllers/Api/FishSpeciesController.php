<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FishSpeciesResource;
use App\Models\FishSpecies;
use Illuminate\Http\Request;

class FishSpeciesController extends Controller
{
    public function index(Request $request)
    {
        $fish_specieses = FishSpecies::when($request->fish_category_id, function ($query) use ($request) {
            $query->where('fish_category_id', $request->fish_category_id);
        })->get();
        if (empty($request->user_id)) $this->sendFailedResponse([], 'Maaf, sepertinya anda harus login ulang');
        $this->sendSuccessResponse([
            'fish_specieses' => FishSpeciesResource::collection($fish_specieses)
        ]);
    }
}
