<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IncomeDetail;
use App\Models\Outcome;
use App\Models\OutcomeDetail;
use Illuminate\Http\Request;

class IncomeOutcomeController extends Controller
{
    public function index(Request $request)
    {
        $income_total = IncomeDetail::whereHas('income', function ($q) use ($request) {
            $q->where('pond_detail_id', $request->pond_detail_id);
        })->sum('total_price');
        $outcome_tetap = Outcome::where('pond_detail_id', $request->pond_detail_id)
            ->whereHas('outcome_detail.outcome_setting', function ($sq) {
                $sq->where('outcome_category_id', 1);
            })->orderBy('id', 'desc');
        $outcomes_lain = Outcome::where('pond_detail_id', $request->pond_detail_id)
            ->orderBy('reported_at', 'desc')->whereHas('outcome_detail.outcome_setting', function ($sq) {
                $sq->where('outcome_category_id', 2);
            })->get();
        $outcome_total = $outcome_tetap->first()->total_nominal ?? 0 + $outcomes_lain->sum('total_nominal') ?? 0;
        $calculation = $income_total / $outcome_total;

        if ($calculation > 1) {
            $calculation_message = "Diatas";
            $calculation_status = 1;
        } else if ($calculation < 1) {
            $calculation_message = "Dibawah";
            $calculation_status = -1;
        } else {
            $calculation_message = "Sama";
            $calculation_status = 0;
        }
        return $this->sendSuccessResponse([
            'income_total' => $income_total,
            'outcome_total' => $outcome_total,
            'calculation' => [
                'calculation_total' => $calculation,
                'calculation_status' => $calculation_status,
                'calculation_message' => $calculation_message,
            ],
        ]);
    }
}
