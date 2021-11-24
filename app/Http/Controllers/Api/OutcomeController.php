<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OutcomeCreateRequest;
use App\Http\Requests\Api\OutcomeShowRequest;
use App\Http\Resources\OutcomeResource;
use App\Models\Outcome;
use App\Models\OutcomeDetail;
use App\Repositories\OutcomeRepository;
use App\Services\OutcomeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OutcomeController extends Controller
{
    public function index(Request $request)
    {
        $outcomes = Outcome::where('pond_detail_id', $request->pond_detail_id)
            ->whereHas('outcome_detail.outcome_setting', function ($sq) use ($request) {
                $sq->where('outcome_category_id', $request->outcome_category_id);
            });
        if ($request->outcome_category_id == 1) {
            return $this->sendSuccessResponse([
                'outcomes' => new OutcomeResource($outcomes->orderBy('id', 'desc')->first()),
            ]);
        }else{
            return $this->sendSuccessResponse([
                'outcomes' => OutcomeResource::collection($outcomes->orderBy('reported_at', 'desc')->get()),
            ]);
        }

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
