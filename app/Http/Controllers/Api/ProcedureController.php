<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Procedure;
use App\Repositories\ProcedureRepository;
use Illuminate\Http\Request;

class ProcedureController extends Controller {
    public function index(Request $request) {
        $this->sendSuccessResponse([
            'procedures'=> ProcedureRepository::get($request->toArray())
        ]);
    }
}
