<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pokdakan;
use Illuminate\Http\Request;

class PokdakanController extends Controller
{
    public function index(Request $request) {
        $this->sendSuccessResponse([
            'pokdakans'=>Pokdakan::when($request->name, function($query) use ($request) {
                $query->where('name', 'ilike', '%'.$request->name.'%');
            })->get()
        ]);   
    }
}
