<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OutcomeSetting;
use Illuminate\Http\Request;

class OutcomeSettingController extends Controller
{
    public function index(Request $request) {
        $this->sendSuccessResponse([
            'outcome_settings'=>OutcomeSetting::with('outcome_category')
                ->when($request->outcome_category_id, function($query) use ($request) {
                    $query->where('outcome_category_id', $request->outcome_category_id);
                })
                ->get()
        ]);
    }
}
