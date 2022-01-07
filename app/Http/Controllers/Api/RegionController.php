<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index(Request $request) {
        return $this->sendSuccessResponse([
            'regions'=>Region::all()
        ]);
    }
}
