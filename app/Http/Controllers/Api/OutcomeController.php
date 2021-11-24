<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OutcomeCreateRequest;
use App\Http\Requests\Api\OutcomeShowRequest;
use App\Models\Outcome;
use App\Models\OutcomeDetail;
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
        foreach ($request->data as $i) {
            OutcomeDetail::create([
                'outcome_id' => $outcome->id,
                'outcome_setting_id' => $i['outcome_setting_id'],
                'price' => $i['price'],
            ]);
        }
        DB::commit();

        return $this->sendSuccessResponse([
            'outcomes' => $outcome->load('outcome_detail')
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
