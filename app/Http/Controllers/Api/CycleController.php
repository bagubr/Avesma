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

    protected function weekly_list($pond_id = [], $date = null)
    {
        $pond_detail_id = PondDetail::whereIn('pond_id', $pond_id)->get()->pluck('id');
        
        $income = Income::select('id', 'reported_at')->when($date, function ($query) use ($date)
        {
            $query->whereDate('reported_at', '>=', $date);  
        })->whereIn('pond_detail_id', $pond_detail_id)->get()->makeHidden(['pond_spesies']);

        $outcome = Outcome::select('id', 'reported_at')->when($date, function ($query) use ($date)
        {
            $query->whereDate('reported_at', '>=', $date);  
        })->whereIn('pond_detail_id', $pond_detail_id)->get()->makeHidden(['outcome_category_name', 'outcome_category']);

        $week_merge = array_merge($income->toArray(), $outcome->toArray());
        if($date){
            $weekly = array_map(function ($item)
            {
                $item2['id'] = $item['id'];
                $item2['name'] = 'Minggu '.date('W', strtotime($item['reported_at']));
                $item2['date'] = date('Y-m-d', strtotime($item['reported_at']));
                $item2['category_name'] = $item['category_name'];
                $item2['total_nominal'] = (isset($item['total_price']))?$item['total_price']:$item['total_nominal'];
                return $item2;
            }, $week_merge);
        }else{
            $weekly = array_map(function ($item)
            {
                $item2['name'] = 'Minggu '.date('W', strtotime($item['reported_at']));
                $item2['date'] = date('Y-m-d', strtotime($item['reported_at']));
                return $item2;
            }, $week_merge);
        }

        if($date){
            return $weekly;
        }
        return array_unique($weekly, SORT_NUMERIC);
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
            'weekly' => $this->weekly_list($ponds->pluck('id')),
        ]);
    }
    
    public function weekly($id, $date)
    {
        $ponds = Pond::where('cycle_id', $id)->get();
        return $this->sendSuccessResponse([
            'weekly' => $this->weekly_list($ponds->pluck('id'), $date),
        ]);
    }

}
