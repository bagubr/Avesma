<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStatusRequest;
use App\Models\Buyer;
use App\Repositories\BuyerRepository;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    public function index(Request $request)
    {
        return $this->sendSuccessResponse([
            'buyers' => BuyerRepository::get($request->toArray())
        ]);
    }

    public function show(Request $request, $id)
    {
        $buyer = BuyerRepository::find($id);

        return $this->sendSuccessResponse([
            'buyer' => $buyer
        ]);
    }

    public function update(UpdateStatusRequest $request, Buyer $buyer)
    {
        $buyer->update([
            'status' => $request->status
        ]);
        $buyer->refresh();

        return $this->sendSuccessResponse([
            'buyer' => $buyer
        ]);
    }
}
