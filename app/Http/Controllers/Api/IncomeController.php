<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateIncomeRequest;
use App\Http\Resources\IncomeIndexResource;
use App\Http\Resources\IncomeTotalResource;
use App\Models\Income;
use App\Models\IncomeDetail;
use App\Repositories\IncomeDetailRepository;
use App\Repositories\IncomeRepository;
use App\Services\IncomeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IncomeController extends Controller
{
    public function index(Request $request)
    {
        $incomes = Income::where('pond_detail_id', $request->pond_detail_id);
        $income_total = IncomeDetail::whereHas('income', function ($q) use ($request) {
            $q->where('pond_detail_id', $request->pond_detail_id);
        })->sum('total_price');
        if (empty($request->pond_detail_id)) $this->sendFailedResponse([], 'Maaf, sepertinya anda harus login ulang');
        $this->sendSuccessResponse([
            'income_total' => $income_total,
            'incomes' => IncomeIndexResource::collection($incomes->get()),
        ]);
        // $this->sendSuccessResponse([
        //     'incomes' => Income::with('income_detail')->when($request->reported_at, function ($query) use ($request) {
        //         $query->whereDate('reported_at', $request->reported_at);
        //     })->when($request->year, function ($query) use ($request) {
        //         $query->whereYear('reported_at', $request->year);
        //     })->when($request->month, function ($query) use ($request) {
        //         $query->whereMonth('reported_at', $request->month);
        //     })
        //         ->when($request->pond_detail_product_id, function ($q) use ($request) {
        //             $q->whereHas('income_detail', function ($query) use ($request) {
        //                 $query->where('pond_detail_product_id', $request->pond_detail_product_id);
        //             });
        //         })
        //         ->simplePaginate(20)
        // ]);
    }
    public function show($id)
    {
        $income = Income::find($id);
        $this->sendSuccessResponse([
            'incomes' => new IncomeIndexResource($income),
        ]);
    }
    public function store(CreateIncomeRequest $request)
    {
        DB::beginTransaction();
        $income = IncomeRepository::createModel($request->pond_detail_id, $request->reported_at);
        $income = IncomeService::create($income, $request->data);
        DB::commit();
        return $this->sendSuccessResponse([
            'income' => $income->load('income_detail')
        ]);
    }
    public function update(CreateIncomeRequest $request, Income $income)
    {
        DB::beginTransaction();
        $data_income = $request->only('pond_detail_id', 'reported_at');
        $income->update($data_income);
        $income->refresh();
        foreach ($income->income_detail as $key) {
            IncomeDetail::destroy($key->id);
        }
        foreach ($request->data as $i) {
            IncomeDetail::create([
                'income_id' => $income->id,
                'pond_detail_product_id' => $i['pond_detail_product_id'],
                'weight' => $i['weight'],
                'price' => $i['price'],
                'total_price' => $i['total_price'],
            ]);
        };
        DB::commit();
        return $this->sendSuccessResponse([
            'income' => $income->load('income_detail')
        ]);
    }
    public function income_statistic(Request $request)
    {
        $incomes = Income::where('pond_detail_id', $request->pond_detail_id)
            ->orderBy('reported_at', 'asc')->get();
        $income_total = IncomeDetail::whereHas('income', function ($q) use ($request) {
            $q->where('pond_detail_id', $request->pond_detail_id);
        })->sum('total_price');
        return $this->sendSuccessResponse([
            'income_total' => $income_total,
            'incomes' => $incomes
        ]);
    }
}
