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
        $outcome_tetap = Outcome::where('pond_detail_id', $request->pond_detail_id)
            ->whereHas('outcome_detail.outcome_setting', function ($sq) {
                $sq->where('outcome_category_id', 1);
            })->orderBy('id', 'desc');
        $outcomes_lain = Outcome::where('pond_detail_id', $request->pond_detail_id)
            ->orderBy('reported_at', 'desc')->get();

        if ($outcome_tetap->get()->count() != 0 && $outcomes_lain->count() != 0) {
            $outcome_tetap_total = $outcome_tetap->total_nominal ?? 0;
            return $this->sendSuccessResponse([
                'outcome_total' => $outcome_tetap_total + $outcomes_lain->sum('total_nominal') ?? 0,
                'outcome_tetap' => new OutcomeResource($outcome_tetap->get()),
                'outcomes_lain' => OutcomeResource::collection($outcomes_lain),
            ]);
        }
        if ($outcome_tetap->get()->count() != 0) {
            $outcome_tetap_total = $outcome_tetap->total_nominal ?? 0;
            return $this->sendSuccessResponse([
                'outcome_total' => $outcome_tetap_total ?? 0,
                'outcome_tetap' => new OutcomeResource($outcome_tetap->get()),
                'outcomes_lain' => "",
            ]);
        }
        if ($outcomes_lain->count() != 0) {
            return $this->sendSuccessResponse([
                'outcome_total' => $outcomes_lain->sum('total_nominal') ?? 0,
                'outcome_tetap' => "",
                'outcomes_lain' => OutcomeResource::collection($outcomes_lain),
            ]);
        }
        return $this->sendSuccessResponse([
            'outcome_total' => 0,
            'outcome_tetap' => "",
            'outcomes_lain' => "",
        ]);
    }
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
    public function update(OutcomeCreateRequest $request, Outcome $outcome)
    {
        DB::beginTransaction();
        $data_outcome = $request->only('pond_detail_id', 'reported_at');
        $outcome->update($data_outcome);
        $outcome->refresh();
        foreach ($outcome->outcome_detail as $key) {
            OutcomeDetail::destroy($key->id);
        }
        foreach ($request->data as $i) {
            OutcomeDetail::create([
                'outcome_id' => $outcome->id,
                'outcome_setting_id' => $i['outcome_setting_id'],
                'price' => $i['price'],
            ]);
        };
        DB::commit();
        return $this->sendSuccessResponse([
            'income' => $outcome->load('outcome_detail')
        ]);
    }

    public function show(Outcome $outcome)
    {
        return $this->sendSuccessResponse([
            'outcome' => new OutcomeResource($outcome)
        ]);
    }
}
