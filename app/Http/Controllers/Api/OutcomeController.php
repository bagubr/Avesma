<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OutcomeCreateRequest;
use App\Http\Requests\Api\OutcomeShowRequest;
use App\Http\Requests\Api\UpdateOutcomeRequest;
use App\Http\Resources\OutcomeResource;
use App\Models\Outcome;
use App\Models\OutcomeDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class OutcomeController extends Controller
{
    public function index(Request $request)
    {
        $outcome_tetap = Outcome::where('cycle_id', $request->cycle_id)
            ->whereHas('outcome_detail.outcome_setting', function ($sq) {
                $sq->where('outcome_category_id', 1);
            })->orderBy('id', 'desc');
        $outcomes_lain = Outcome::where('cycle_id', $request->cycle_id)
            ->orderBy('reported_at', 'desc')->whereHas('outcome_detail.outcome_setting', function ($sq) {
                $sq->where('outcome_category_id', 2);
            })->get();

        $total_nominal_tetap = $outcome_tetap->first()->total_nominal ?? 0;
        return $this->sendSuccessResponse([
            'outcome_total' => $total_nominal_tetap + $outcomes_lain->sum('total_nominal') ?? 0,
            'outcome_tetap' => $outcome_tetap->first() ?? new stdClass(),
            'outcomes_lain' => $outcomes_lain,
        ]);
    }
    public function outcome_statistic(Request $request)
    {
        $outcome_tetap = Outcome::where('cycle_id', $request->cycle_id)
            ->whereHas('outcome_detail.outcome_setting', function ($sq) {
                $sq->where('outcome_category_id', 1);
            })->orderBy('id', 'desc');
        $outcomes_lain = Outcome::where('cycle_id', $request->cycle_id)
            ->orderBy('reported_at', 'asc')->whereHas('outcome_detail.outcome_setting', function ($sq) {
                $sq->where('outcome_category_id', 2);
            })->get();

        return $this->sendSuccessResponse([
            'outcome_total' => $outcome_tetap->first()->total_nominal ?? 0 + $outcomes_lain->sum('total_nominal') ?? 0,
            'outcome_tetap' => $outcome_tetap->first() ?? new stdClass(),
            'outcomes_lain' => $outcomes_lain,
        ]);
    }
    public function store(OutcomeCreateRequest $request)
    {
        DB::beginTransaction();
        $outcome = Outcome::create([
            'cycle_id' => $request->cycle_id,
            'reported_at' => $request->reported_at,
            'outcome_category_id' => $request->outcome_category_id
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
            'outcome' => $outcome->load('outcome_detail')
        ]);
    }
    public function update(UpdateOutcomeRequest $request, Outcome $outcome)
    {
        DB::beginTransaction();
        $data_outcome = $request->only('cycle_id', 'reported_at', 'outcome_category_id');
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
            'outcome' => $outcome->load('outcome_detail')
        ]);
    }

    public function show(Outcome $outcome)
    {
        return $this->sendSuccessResponse([
            'outcome' => new OutcomeResource($outcome)
        ]);
    }
}
