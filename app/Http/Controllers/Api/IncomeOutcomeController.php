<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Income;
use Illuminate\Http\Request;

class IncomeOutcomeController extends Controller
{
    public function index(Request $request)
    {
        $incomes = Income::where('pond_detail_id', $request->pond_detail_id)->get();
        dd($incomes);
    }
}
