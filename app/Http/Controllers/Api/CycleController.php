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

    protected function unique_multidim_array($array, $key) {
        $temp_array = array();
        $i = 0;
        $key_array = array();
       
        foreach($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }

    protected function weekly_list($pond_detail_id = [], $start_date = null, $end_date = null)
    {
        $income = Income::select('id', 'reported_at', 'pond_detail_id')
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date)
        {
            $query->whereBetween('reported_at', [$start_date, $end_date]);
        })
        ->whereIn('pond_detail_id', $pond_detail_id)->get()->makeHidden(['pond_spesies']);
        
        $outcome = Outcome::select('id', 'reported_at', 'pond_detail_id')
        ->when($start_date && $end_date, function ($query) use ($start_date, $end_date)
        {
            $query->whereBetween('reported_at', [$start_date, $end_date]);
        })
        ->whereIn('pond_detail_id', $pond_detail_id)->get()->makeHidden(['outcome_category_name', 'outcome_category']);

        $week_merge = array_merge($income->toArray(), $outcome->toArray());
        $weekly = array_map(function ($item)
        {
            $item2['id'] = $item['id'];
            $item2['name'] = 'Minggu '.date('W', strtotime($item['reported_at']));
            $item2['pond_detail_id'] = $item['pond_detail_id'];
            $item2['reported_at'] = date('Y-m-d', strtotime($item['reported_at']));
            $item2['start_date'] = date('Y-m-d', strtotime($item['reported_at']));
            $item2['end_date'] = date('Y-m-d', strtotime("+7 day", strtotime($item['reported_at'])));
            $item2['category_name'] = $item['category_name'];
            $item2['total_nominal'] = (isset($item['total_price']))?$item['total_price']:$item['total_nominal'];
            return $item2;
        }, $week_merge);

        return $weekly;
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
        $ponds = Pond::where('cycle_id', $id)->get();
        $pond_detail_id = PondDetail::whereIn('pond_id', $ponds->pluck('id'))->get()->pluck('id');
        $sum_income = IncomeDetail::whereHas('income', function ($q) use ($pond_detail_id) {
            $q->whereIn('pond_detail_id', $pond_detail_id);
        })->sum('total_price');
        $sum_outcome = OutcomeDetail::whereHas('outcome', function ($q) use ($pond_detail_id) {
            $q->whereIn('pond_detail_id', $pond_detail_id);
        })->sum('price');
        $ratio = new IncomeOutcomeController();
        return $this->sendSuccessResponse([
            'sum_income' => (int) $sum_income,
            'sum_outcome' => (int) $sum_outcome,
            'ratio' => $ratio->incomeOutcome($pond_detail_id)['calculation'],
            'cycle' => $cycles,
            'ponds' => PondAndPondDetailResource::collection($ponds),
            'weekly' => $this->unique_multidim_array($this->weekly_list($pond_detail_id, $cycles['start_at']),'name'),
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
        $pond_detail_id = PondDetail::whereIn('pond_id', $ponds->pluck('id'))->get()->pluck('id');
        $end_date = date('Y-m-d', strtotime("+7 day", strtotime($date)));
        return $this->sendSuccessResponse([
            'weekly' => $this->weekly_list($pond_detail_id, $date, $end_date),
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
