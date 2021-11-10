<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OutcomeCategory;
use Illuminate\Http\Request;

class OutcomeCategoryController extends Controller
{
    public function index(Request $request) {
        $this->sendSuccessResponse([
            'outcome_categories'=>OutcomeCategory::all()
        ]);
    }
}
