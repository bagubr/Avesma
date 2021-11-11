<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ProcedureRepository;
use Illuminate\Http\Request;

class FormProcedureController extends Controller {
    public function index(Request $request) {
        return $this->sendSuccessResponse([
            'procedures'=>ProcedureRepository::get($request->toArray())
        ]);
    }
}