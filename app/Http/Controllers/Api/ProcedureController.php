<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateFormProcedrueInputUserRequest;
use App\Http\Requests\Api\UpdateFormProcedureInputUserRequest;
use App\Http\Requests\ProcedureRequest;
use App\Http\Resources\ProcedureUserResource;
use App\Models\FormProcedure;
use App\Models\FormProcedureDetail;
use App\Models\FormProcedureDetailFormula;
use App\Models\FormProcedureDetailInput;
use App\Models\FormProcedureFormula;
use App\Models\FormProcedureInputUser;
use App\Models\Procedure;
use App\Repositories\ProcedureRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            ->where('form_procedure_id', $request->form_procedure_id)->orderBy('id')->get();
        return $this->sendSuccessResponse([
            'form_procedure_input_users' => ProcedureUserResource::collection($procedure_users)
        ]);
    }
    public function getProcedureShow($id)
    {
        $procedure_user = FormProcedureInputUser::find($id);
        return $this->sendSuccessResponse([
            'form_procedure_input_user' => new ProcedureUserResource($procedure_user)
        ]);
    }
    public function getFormProcedure($id)
    {
        $form_procedure = FormProcedure::where('id', $id)
            ->with('form_procedure_detail.form_procedure_detail_formulas')->first();
        $this->sendSuccessResponse([
            'form_procedure' => $form_procedure
        ]);
    }
    public function store(CreateFormProcedrueInputUserRequest $request)
    {
        DB::beginTransaction();
        $form_procedure_input_user = FormProcedureInputUser::create([
            'user_id' => $request->user()->id,
            'pond_detail_id' => $request->pond_detail_id,
            'reported_at' => $request->reported_at,
            'form_procedure_id' => $request->form_procedure_id,
        ]);
        foreach ($request->data as $i) {
            FormProcedureDetailInput::create([
                'form_procedure_detail_id' => $i['form_procedure_detail_id'],
                'form_procedure_detail_formula_id' => $i['form_procedure_detail_formula_id'],
                'form_procedure_input_user_id' => $form_procedure_input_user->id,
                'score' => FormProcedureDetailFormula::where('id', $i['form_procedure_detail_formula_id'])->first()->score,
            ]);
        };
        DB::commit();

        return $this->sendSuccessResponse([
            'procedure' => $form_procedure_input_user->load('form_procedure_detail_input')
        ]);
    }
    public function update(UpdateFormProcedureInputUserRequest $request, FormProcedureInputUser $form_procedure_input_user)
    {
        DB::beginTransaction();
        $form_procedure_input_user->update([
            'reported_at' => $request->reported_at,
        ]);
        foreach ($form_procedure_input_user->form_procedure_detail_input as $key) {
            FormProcedureDetailInput::destroy($key->id);
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
