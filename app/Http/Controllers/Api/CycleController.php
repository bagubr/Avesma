<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CycleRequest;
use App\Http\Resources\PondAndPondDetailResource;
use App\Models\Cycle;
use App\Models\Income;
use App\Models\Outcome;
use App\Models\Pond;
use App\Models\PondDetail;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

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

    protected function weekly_list($pond_id = [], $start_date = null, $end_date = null)
    {
        $pond_detail_id = PondDetail::whereIn('pond_id', $pond_id)->get()->pluck('id');
        
        $income = Income::select('id', 'reported_at')
        ->when($start_date, function ($query) use ($start_date)
        {
            $query->whereDate('reported_at', '>=', $start_date);  
        })
        ->when($end_date, function ($query) use ($end_date)
        {
            $query->whereDate('reported_at', '<=', $end_date);  
        })
        ->whereIn('pond_detail_id', $pond_detail_id)->get()->makeHidden(['pond_spesies']);

        $outcome = Outcome::select('id', 'reported_at')
        ->when($start_date, function ($query) use ($start_date)
        {
            $query->whereDate('reported_at', '>=', $start_date);  
        })
        ->when($end_date, function ($query) use ($end_date)
        {
            $query->whereDate('reported_at', '<=', $end_date);  
        })
        ->whereIn('pond_detail_id', $pond_detail_id)->get()->makeHidden(['outcome_category_name', 'outcome_category']);

        $week_merge = array_merge($income->toArray(), $outcome->toArray());
        $weekly = array_map(function ($item)
        {
            $item2['id'] = $item['id'];
            $item2['name'] = 'Minggu '.date('W', strtotime($item['reported_at']));
            $item2['reported_at'] = date('Y-m-d', strtotime($item['reported_at']));
            $item2['start_date'] = date('Y-m-d', strtotime($item['reported_at']));
            $item2['end_date'] = date('Y-m-d', strtotime("+7 day", strtotime($item['reported_at'])));
            $item2['category_name'] = $item['category_name'];
            $item2['total_nominal'] = (isset($item['total_price']))?$item['total_price']:$item['total_nominal'];
            return $item2;
        }, $week_merge);

        return $weekly;
    }

    public function index(Request $request)
    {
        $cycles = Cycle::where('user_id', $request->user()->id)->get();
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
        $cycles = Cycle::findOrFail($id);
        $ponds = Pond::where('cycle_id', $id)->get();
        return $this->sendSuccessResponse([
            'cycle' => $cycles,
            'ponds' => PondAndPondDetailResource::collection($ponds),
            'weekly' => $this->unique_multidim_array($this->weekly_list($ponds->pluck('id'), $cycles['start_at']),'name'),
        ]);
    }
    
    public function weekly($id, $date)
    {
        $ponds = Pond::where('cycle_id', $id)->get();
        $end_date = date('Y-m-d', strtotime("+7 day", strtotime($date)));
        return $this->sendSuccessResponse([
            'weekly' => $this->weekly_list($ponds->pluck('id'), $date, $end_date),
        ]);
    }

}
