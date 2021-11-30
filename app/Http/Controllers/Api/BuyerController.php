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
        $buyers = Buyer::whereHas('pond_detail.pond', function ($q) use ($request) {
            $q->where('user_id', $request->user()->id);
        })->orderBy('id', 'desc')->get();
        return $this->sendSuccessResponse([
            'buyers' => $buyers
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
            'buyer' => $buyer->load('pond_Detail')
        ]);
    }
}
