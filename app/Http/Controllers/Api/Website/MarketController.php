<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\Http\Resources\PondResource;
use App\Models\Pond;
use App\Models\PondHarvest;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function index(Request $request)
    {
        $pond_harvests = PondHarvest::with('pond_detail.pond')->where('status', PondHarvest::STATUS1)
            ->when($request->fish_name, function ($query) use ($request) {
                $query->whereHas('pond_detail.fish_species', function ($q) use ($request) {
                    $q->where('name', 'ilike', "%" . $request->fish_name . "%");
                });
            })->when($request->fish_category_id, function ($query) use ($request) {
                $query->whereHas('pond_detail.fish_species', function ($q) use ($request) {
                    $q->where('fish_category_id', $request->fish_category_id);
                });
            })->when($request->region_id, function ($query) use ($request) {
                $query->whereHas('pond_detail.pond', function ($q) use ($request) {
                    $q->whereHas('user', function ($sq) use ($request) {
                        $sq->where('region_id', $request->region_id);
                    });
                });
            })->orderBy('id', 'desc')->get();
        if ($pond_harvests->isEmpty()) {
            $this->sendFailedResponse([], 'Maaf, Data Yang Anda Cari Tidak Ada...');
        }

        $this->sendSuccessResponse([
            'pond_harvests' => $pond_harvests
        ]);
    }
}
