<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProcedureUserResource;
use App\Models\FormProcedure;
use App\Models\FormProcedureDetail;
use App\Models\FormProcedureDetailFormula;
use App\Models\FormProcedureDetailInput;
use App\Models\FormProcedureInputUser;
use App\Models\Procedure;
use App\Repositories\ProcedureRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProcedureController extends Controller
{
    public function index(Request $request)
    {
        $this->sendSuccessResponse([
            'procedures' => ProcedureRepository::get($request->toArray())
        ]);
    }
    public function getProcedureList()
    {
        $procedure_users = FormProcedureInputUser::all();
        return $this->sendSuccessResponse([
            'procedures' => ProcedureUserResource::collection($procedure_users)
        ]);
    }
    public function inputdetail(Request $request)
    {
        $procedures_detail = FormProcedure::with('form_procedure_detail.form_procedure_detail_formulas')->where('fish_species_id', $request->fish_species_id)
            ->when($request->procedure_id, function ($query) use ($request) {
                $query->where('procedure_id', $request->procedure_id);
            })->get()->first();
        if (empty($request->fish_species_id && $request->procedure_id)) {
            $this->sendFailedResponse([], 'Maaf Anda Belum Memilih Spesies Ikan atau SOP');
        }
        $this->sendSuccessResponse([
            'procedure' => $procedures_detail
        ]);
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        $form_procedure_input_user = FormProcedureInputUser::create([
            'user_id' => $request->user_id,
            'pond_detail_id' => $request->pond_detail_id,
            'reported_at' => $request->reported_at,
        ]);
        foreach ($request->data as $i) {
            FormProcedureDetailInput::create([
                'form_procedure_detail_id' => $i['form_procedure_detail_id'],
                'form_procedure_detail_formula_id' => $i['form_procedure_detail_formula_id'],
                'score' => FormProcedureDetailFormula::findOrFail($i['form_procedure_detail_formula_id'])->score,
                'form_procedure_input_user_id' => $form_procedure_input_user->id,
            ]);
        };
        DB::commit();

        return $this->sendSuccessResponse([
            'procedure' => $form_procedure_input_user->load('form_procedure_detail_input')
        ]);
    }
}
