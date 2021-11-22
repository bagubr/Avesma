<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FormProcedure;
use App\Models\FormProcedureDetail;
use App\Models\FormProcedureInputUser;
use App\Models\Procedure;
use App\Repositories\ProcedureRepository;
use Illuminate\Http\Request;

class ProcedureController extends Controller
{
    public function index(Request $request)
    {
        $this->sendSuccessResponse([
            'procedures' => ProcedureRepository::get($request->toArray())
        ]);
    }
    public function inputdetail(Request $request)
    {
        $procedures_detail = FormProcedure::with('form_procedure_detail.form_procedure_detail_formulas')->where('fish_species_id', $request->fish_species_id)
            ->when($request->procedure_id, function ($query) use ($request) {
                $query->where('procedure_id', $request->procedure_id);
            })->get();
        if (empty($request->fish_species_id)) {
            $this->sendFailedResponse([], 'Maaf Anda Belum Memilih Spesies Ikan');
        }
        $this->sendSuccessResponse([
            'procedures' => $procedures_detail
        ]);
    }
    public function store(Request $request)
    {
        $form_procedure_input_user = FormProcedureInputUser::create([
            'user_id' => $request->user_id,
            'pond_detail_id' => $request->pond_detail_id,
            'reported_at' => $request->reported_at,
        ]);
        return $this->sendSuccessResponse([
            'procedure' => $form_procedure_input_user
        ]);
    }
}
