<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateIncomeRequest;
use App\Models\Income;
use App\Repositories\IncomeDetailRepository;
use App\Repositories\IncomeRepository;
use App\Services\IncomeService;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index(Request $request) {
        $this->sendSuccessResponse([
            'incomes'=>Income::with('income_detail')->when($request->reported_at, function($query) use ($request) {
                $query->whereDate('reported_at', $request->reported_at);
            })->when($request->year, function($query) use ($request) {
                $query->whereYear('reported_at', $request->year);
            })->when($request->month, function($query) use ($request) {
                $query->whereMonth('reported_at', $request->month);
            })
            ->when($request->name, function($q) use ($request) {
                $q->whereHas('income_detail', function($query) use ($request) {
                    $query->where('name', 'ilike', '%'.$request->name.'%');
                });
            })
            ->simplePaginate(20)
        ]);
    }
    public function store(CreateIncomeRequest $request) {
        $income = IncomeRepository::createModel($request->pond_detail_id, $request->reported_at);        
        $income_detail = IncomeDetailRepository::createModel(null, $request->name, $request->weight, $request->price, $request->total_price);
        [$income, $income_detail] = IncomeService::create($income, $income_detail);

        return $this->sendSuccessResponse([]);
    }
}
