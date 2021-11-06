<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Procedure;
use Illuminate\Http\Request;

class ProcedureController extends Controller {
    public function index(Request $request) {
        $this->sendSuccessResponse([
            'procedures'=>Procedure::when($request->title, function($query) use ($request) {
                $query->where('title', 'ilike', '%'.$request->title.'%');
            })->get()
        ]);
    }
}
