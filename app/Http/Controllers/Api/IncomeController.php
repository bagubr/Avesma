<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateIncomeRequest;
use App\Http\Requests\Api\UpdateIncomeRequest;
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
        $incomes = Income::where('cycle_id', $request->cycle_id)->orderBy('reported_at', 'desc');
        $income_total = IncomeDetail::whereHas('income', function ($q) use ($request) {
            $q->where('cycle_id', $request->cycle_id);
        })->sum('total_price');
        $this->sendSuccessResponse([
            'income_total' => $income_total,
            'incomes' => IncomeIndexResource::collection($incomes->get()),
        ]);
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
        $income = IncomeRepository::createModel($request->cycle_id, $request->reported_at);
        $income = IncomeService::create($income, $request->data);
        DB::commit();
        return $this->sendSuccessResponse([
            'income' => $income->load('income_detail')
        ]);
    }
    public function update(UpdateIncomeRequest $request, Income $income)
    {
        DB::beginTransaction();
        $data = $request->only('cycle_id', 'reported_at');
        $income->update($data);
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
        $incomes = Income::where('cycle_id', $request->cycle_id)
            ->orderBy('reported_at', 'asc')->get();
        $income_total = IncomeDetail::whereHas('income', function ($q) use ($request) {
            $q->where('cycle_id', $request->cycle_id);
        })->sum('total_price');
        return $this->sendSuccessResponse([
            'income_total' => $income_total,
            'incomes' => $incomes
        ]);
    }
}
