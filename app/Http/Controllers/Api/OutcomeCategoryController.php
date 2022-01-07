<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OutcomeCategoryResource;
use App\Models\OutcomeCategory;
use Illuminate\Http\Request;

class OutcomeCategoryController extends Controller
{
    public function index(Request $request)
    {
        $outcome_categories = OutcomeCategory::when($request->outcome_category_id, function ($q) use ($request) {
            $q->where('id', $request->outcome_category_id);
        });
        if ($request->outcome_category_id) {
            $this->sendSuccessResponse([
                'outcome_categories' => new OutcomeCategoryResource($outcome_categories->first())
            ]);
        } else {
            $this->sendSuccessResponse([
                'outcome_categories' => OutcomeCategoryResource::collection($outcome_categories->get())
            ]);
        }
    }
}
