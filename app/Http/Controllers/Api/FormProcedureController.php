<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FormProcedure;
use App\Models\FormProcedureInputUser;
use App\Repositories\ProcedureRepository;
use Illuminate\Http\Request;

class FormProcedureController extends Controller
{
    public function index(Request $request)
    {
        return $this->sendSuccessResponse([
            'procedures' => ProcedureRepository::get($request->toArray())
        ]);
    }
    public function procedure_graphics(Request $request)
    {
        $form_procedures = FormProcedure::whereHas('form_procedure_input_users', function ($q) use ($request){
            $q->where('pond_detail_id', $request->pond_detail_id);
        })->with('form_procedure_input_users')->get();
        return $this->sendSuccessResponse([
            'procedures_statistic' => $form_procedures
        ]);
    }
}
