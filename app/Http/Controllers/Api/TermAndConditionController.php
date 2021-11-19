<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TermAndCondition;
use Illuminate\Http\Request;

class TermAndConditionController extends Controller
{
    public function index()
    {
        $term_condition = TermAndCondition::first();
        return $this->sendSuccessResponse(['term_and_condition' => $term_condition]);
    }
}
