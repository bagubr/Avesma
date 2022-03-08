<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IncomeDetail;
use App\Models\Outcome;
use App\Models\OutcomeDetail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class IncomeOutcomeController extends Controller
{
    public function incomeOutcome($pond_detail_id)
    {
        $data['income_total'] = IncomeDetail::whereHas('income', function ($q) use ($pond_detail_id) {
            $q->when(is_countable($pond_detail_id), function ($q2) use ($pond_detail_id)
            {
                $q2->whereIn('pond_detail_id', $pond_detail_id);
            });
            $q->when(!is_countable($pond_detail_id), function ($q2) use ($pond_detail_id)
            {
                $q2->where('pond_detail_id', $pond_detail_id);
            });
        })->sum('total_price');
        $data['outcome_total'] = OutcomeDetail::whereHas('outcome', function ($q) use ($pond_detail_id) {
            $q->when(is_countable($pond_detail_id), function ($q2) use ($pond_detail_id)
            {
                $q2->whereIn('pond_detail_id', $pond_detail_id);
            });
            $q->when(!is_countable($pond_detail_id), function ($q2) use ($pond_detail_id)
            {
                $q2->where('pond_detail_id', $pond_detail_id);
            });
        })->sum('price');
        $data['calculation']['calculation_total'] = $data['income_total'] ?? 0 / $data['outcome_total'] ?? 0;

        $data['calculation'] = $this->indexRatio($data['calculation']['calculation_total']);
        return $data;    
    }

    public function indexRatio($total_price)
    {
        if ($total_price > 1) {
            $data['calculation_message'] = "Diatas";
            $data['calculation_status'] = 1;
        } else if ($total_price < 1) {
            $data['calculation_message'] = "Dibawah";
            $data['calculation_status'] = -1;
        } else {
            $data['calculation_message'] = "Sama";
            $data['calculation_status'] = 0;
        }
        return $data;
    }

    public function index(Request $request)
    {
        return $this->sendSuccessResponse($this->incomeOutcome($request->pond_detail_id));
    }
}
