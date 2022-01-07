<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FishCategory;
use Illuminate\Http\Request;

class FishCategoryController extends Controller
{
    public function index(Request $request) {
        return $this->sendSuccessResponse([
            'fish_categories'=>FishCategory::when($request->name, function($query) use ($request) {
                $query->where('name', 'ilike', '%'.$request->name.'%');
            })->get()
        ]);
    }
}
