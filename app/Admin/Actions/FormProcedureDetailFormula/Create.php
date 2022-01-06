<?php

namespace App\Admin\Actions\FormProcedureDetailFormula;

use App\Models\FormProcedure;
use App\Models\FormProcedureDetail;
use App\Models\FormProcedureDetailFormula;
use Encore\Admin\Actions\RowAction;
use Encore\Admin\Form;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request;

class Create extends RowAction
{
    
    public $name = 'Tambah Parameter';

    public function handle(Model $model, HttpRequest $request)
    {
        $form_procedure_detail_formula = new FormProcedureDetailFormula();
        $form_procedure_detail_formula->form_procedure_detail_id = $model->id;
        $form_procedure_detail_formula->parameter = $request->get('parameter');
        $form_procedure_detail_formula->score = preg_replace('/[^0-9]/', '', $request->get('score'));
        $form_procedure_detail_formula->save();
        return $this->response()->success('Success message.')->refresh();
    }

    public function form()
    {
        $this->text('parameter', __('Parameter'));
        $this->integer('score', __('Score'));
    }

}