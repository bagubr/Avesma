<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FishSpecies;
use Illuminate\Http\Request;

class FishSpeciesController extends Controller
{
    public function index(Request $request) {
        $this->sendSuccessResponse([
            'fish_specieses'=>FishSpecies::when($request->name, function($query) use ($request) {
                $query->where('name', 'ilike', '%'.$request->name.'%');
            })->get()
        ]);
    }
}
