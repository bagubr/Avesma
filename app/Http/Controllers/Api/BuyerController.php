<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Repositories\BuyerRepository;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    public function index(Request $request) {
        return $this->sendSuccessResponse([
            'buyers'=>BuyerRepository::get($request->toArray())
        ]);
    }
}
