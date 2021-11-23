<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProcedureRequest;
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
use Illuminate\Support\Facades\Validator;

class ProcedureController extends Controller
{
    public function index(Request $request)
    {
        if ($request->toArray()) {
            $this->sendSuccessResponse([
                'procedures' => ProcedureRepository::search($request->toArray())
            ]);
        } else {
            $this->sendSuccessResponse([
                'procedures' => ProcedureRepository::get()
            ]);
        }
    }
    public function getProcedureList(Request $request)
    {
        $procedure_users = FormProcedureInputUser::where('pond_detail_id', $request->pond_detail_id)
            ->where('form_procedure_id', $request->form_procedure_id)->get();
        return $this->sendSuccessResponse([
            'procedures' => ProcedureUserResource::collection($procedure_users)
        ]);
    }
    public function getProcedureShow($id)
    {
        $procedure_user = FormProcedureInputUser::find($id);
        return $this->sendSuccessResponse([
            'procedure' => new ProcedureUserResource($procedure_user)
        ]);
    }
    public function getFormProcedure($id)
    {
        // $procedures_detail = FormProcedure::with('form_procedure_detail.form_procedure_detail_formulas')->where('fish_species_id', $request->fish_species_id)
        //     ->when($request->procedure_id, function ($query) use ($request) {
        //         $query->where('procedure_id', $request->procedure_id);
        //     })->get()->first();

        $form_procedure = FormProcedure::where('id', $id)
            ->with('form_procedure_detail.form_procedure_detail_formulas')->first();
        $this->sendSuccessResponse([
            'form_procedure' => $form_procedure
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'user_id' => 'required|exists:users,id',
            'pond_detail_id' => 'required|exists:pond_details,id',
            'reported_at' => 'required',
            'form_procedure_id' => 'required|exists:form_procedures,id',
        ]);
        DB::beginTransaction();
        if ($validator->fails()) {
            return $this->sendFailedResponse(['errors' => $validator->errors()]);
        }
        $form_procedure_input_user = FormProcedureInputUser::create([
            'user_id' => $request->user_id,
            'pond_detail_id' => $request->pond_detail_id,
            'reported_at' => $request->reported_at,
            'form_procedure_id' => $request->form_procedure_id,
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
    public function update(Request $request, FormProcedureInputUser $form_procedure_input_user)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'reported_at' => 'required',
        ]);
        DB::beginTransaction();
        if ($validator->fails()) {
            return $this->sendFailedResponse(['errors' => $validator->errors()]);
        }
        $form_procedure_input_user->update([
            'reported_at' => $request->reported_at,
        ]);
        foreach ($form_procedure_input_user->form_procedure_detail_input as $key) {
            $key->destroy($key->id);
        }
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
