<?php

namespace App\Admin\Actions\FormProcedureDetailFormula;

use App\Models\FormProcedure;
use App\Models\FormProcedureDetail;
use App\Models\FormProcedureDetailFormula;
use Encore\Admin\Actions\RowAction;
use Encore\Admin\Form;
use Illuminate\Database\Eloquent\Model;

class Create extends RowAction
{
    public $name = 'Tambah Parameter';

    public function handle(Model $model)
    {
        return $this->response()->success('Success message.')->refresh();
    }

    public function form()
    {
        $form = new Form(new FormProcedureDetailFormula());
        $form->hidden('form_procedure_detail_id', __('Formulir'))->value(@$_GET['form_procedure_detail_id']);
        $form->text('parameter', __('Parameter'));
        $form->decimal('score', __('Score'));
        $form->saved(function (Form $form) {
            return redirect('/admin/form-procedure-details/'.$form->form_procedure_detail_id);
        });
        return $form;
    }

}