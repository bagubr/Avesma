<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CycleRequest;
use App\Http\Resources\PondAndPondDetailResource;
use App\Models\Cycle;
use App\Models\Income;
use App\Models\IncomeDetail;
use App\Models\Outcome;
use App\Models\OutcomeDetail;
use App\Models\Pond;
use App\Models\PondDetail;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CycleController extends Controller
{

    protected function weekly_list($cycle_id = [])
    {
        $income = Income::select('id', 'reported_at', 'cycle_id')
        ->where('cycle_id', $cycle_id);
        $array = Outcome::select('id', 'reported_at', 'cycle_id')
        ->where('cycle_id', $cycle_id)->union($income)->orderBy('reported_at')->get()->makeHidden(['outcome_category_name', 'outcome_category'])
        ->groupBy(function($item) {
                return Carbon::parse($item->reported_at)->format('W');
            });
        $weekly = 1;
        foreach ($array as $value) {
            $start_date = Carbon::parse($value[array_key_first($value->toArray())]['reported_at']);
            $end_date = Carbon::parse($value[array_key_last($value->toArray())]['reported_at']);
            $data[] = [
                'week' =>$weekly++,
                'start_date' => $start_date->startOfWeek()->format('Y-m-d H:i:s'),
                'end_date' => $end_date->endOfWeek()->format('Y-m-d H:i:s'),
            ];
        }
        return $data;
    }

    protected function weekly_detail_list($cycle_id = [], $start_date = null, $end_date = null)
    {
        $income = Income::select('id', 'reported_at', 'cycle_id')
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date)
        {
            $query->whereBetween('reported_at', [$start_date, $end_date]);
        })
        ->where('cycle_id', $cycle_id);
        $data = Outcome::select('id', 'reported_at', 'cycle_id')
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date)
        {
            $query->whereBetween('reported_at', [$start_date, $end_date]);
        })
        ->where('cycle_id', $cycle_id)->union($income)->orderBy('reported_at')->get()->makeHidden(['outcome_category_name', 'outcome_category']);
        return $data;
    }

    public function indexFinish(Request $request)
    {
        $cycles = Cycle::where('user_id', $request->user()->id)->where('status', Cycle::FINISH)->get();
        return $this->sendSuccessResponse([
            'cycles' => $cycles,
        ]);
    }

    public function indexOngoing(Request $request)
    {
        $cycles = Cycle::where('user_id', $request->user()->id)->where('status', Cycle::ONGOING)->get();
        return $this->sendSuccessResponse([
            'cycles' => $cycles,
        ]);
    }

    public function store(CycleRequest $request)
    {
        $cycles = Cycle::create(array_merge($request->all(), [
            'user_id' => $request->user()->id,
            'status'  => Cycle::ONGOING,
        ]));
        return $this->sendSuccessResponse([
            'cycle' => $cycles,
        ]);
    }

    public function update(CycleRequest $request, $id)
    {
        $cycles = Cycle::findOrFail($id);
        $cycles->update($request->all());
        return $this->sendSuccessResponse([
            'cycle' => $cycles,
        ]);
    }
    
    public function show($id)
    {
        $cycles = Cycle::withCount('ponds')->findOrFail($id);
        $cycle_id = $id;
        $sum_income = IncomeDetail::whereHas('income', function ($q) use ($cycle_id) {
            $q->where('cycle_id', $cycle_id);
        })->sum('total_price');
        $sum_outcome = OutcomeDetail::whereHas('outcome', function ($q) use ($cycle_id) {
            $q->where('cycle_id', $cycle_id);
        })->sum('price');
        $ratio = new IncomeOutcomeController();
        return $this->sendSuccessResponse([
            'sum_income' => (int) $sum_income,
            'sum_outcome' => (int) $sum_outcome,
            'ratio' => $ratio->incomeOutcome($cycle_id)['calculation'],
            'cycle' => $cycles,
            'ponds' => PondAndPondDetailResource::collection(Pond::where('cycle_id', $id)->get()),
            'weekly' => $this->weekly_list($cycle_id),
        ]);
    }

    public function ponds($id)
    {
        $ponds = Pond::where('cycle_id', $id)->get();
        return $this->sendSuccessResponse([
            'ponds' => PondAndPondDetailResource::collection($ponds),
        ]);
    }
    
    public function weekly($id, $date)
    {
        $ponds = Pond::where('cycle_id', $id)->get();
        $start_date = Carbon::parse($date)->startOfWeek()->format('Y-m-d H:i:s');
        $end_date = Carbon::parse($date)->endOfWeek()->format('Y-m-d H:i:s');
        return $this->sendSuccessResponse([
            'weekly' => $this->weekly_detail_list($id, $start_date, $end_date),
        ]);
    }

    public function ratio($id)
    {
        $ponds = Pond::where('cycle_id', $id)->get();
        $pond_detail_id = PondDetail::whereIn('pond_id', $ponds->pluck('id'))->get()->pluck('id');
        $data = $this->weekly_list($pond_detail_id);
        usort($data, fn ($a, $b) => strtotime($b["reported_at"]) - strtotime($a["reported_at"]));
        $ratio_history = [];
        $income_total = 0;
        $outcome_total = 0;
        $ratio = new IncomeOutcomeController();
        foreach ($data as $key => $value) {
            if($value['category_name'] == 'INCOME'){
                $income_total += $value['total_nominal'];
            }
            if($value['category_name'] == 'OUTCOME'){
                $outcome_total += $value['total_nominal'];
            }
            $total = $income_total;
            if($outcome_total > 0){
                $total = $income_total / $outcome_total;
            }
            $ratio_history[] = [
                'calculation_message' => $ratio->indexRatio($total)['calculation_message'],
                'calculation_status' => $ratio->indexRatio($total)['calculation_status'],
                'reported_at' => $value['reported_at'],
                'total' => $value['total_nominal'],
                'income' => $income_total,
                'outcome' => $outcome_total,
                'total_bersih' => $total,
                'category_name' => $value['category_name'],
            ];
        }
        return $this->sendSuccessResponse([
            'ratio' => $ratio->incomeOutcome($pond_detail_id)['calculation'],
            'ratio_detail' => $ratio_history,
        ]);
    }
}
