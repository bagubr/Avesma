<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OutcomeCreateRequest;
use App\Http\Requests\Api\OutcomeShowRequest;
use App\Models\Outcome;
use App\Repositories\OutcomeRepository;
use App\Services\OutcomeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OutcomeController extends Controller
{
    public function index()
    {
        $outcomes = Outcome::all();
        return $this->sendSuccessResponse([
            'outcomes' => $outcomes,
        ]);
    }
    // public function index(Request $request) {
    //     $outcomes = OutcomeRepository::get();
    //     $total = OutcomeRepository::total();

    //     return $this->sendSuccessResponse([
    //         'total'=>$total,
    //         'outcomes'=>$outcomes,
    //     ]);
    // }

    public function store(OutcomeCreateRequest $request)
    {
        DB::beginTransaction();
        $outcome = Outcome::create([
            'pond_detail_id' => $request->pond_detail_id,
            'reported_at' => $request->reported_at
        ]);
        DB::commit();
        // $outcomes = OutcomeService::create($request->reported_at, $request->pond_detail_id, $request->data);       

        return $this->sendSuccessResponse([
            'outcomes' => $outcome
        ]);
    }

    public function show(OutcomeShowRequest $request)
    {
        $outcomes = OutcomeRepository::getByReportedAtAndPondDetail($request->reported_at, $request->pond_detail_id);
        $total = OutcomeRepository::sumCountByReportedAtAndPondDetail($request->reported_at, $request->pond_detail_id);

        return $this->sendSuccessResponse([
            'outcomes' => $outcomes,
            'total' => $total
        ]);
    }
}
