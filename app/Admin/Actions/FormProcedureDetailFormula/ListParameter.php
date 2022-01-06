<?php

namespace App\Admin\Actions\FormProcedureDetailFormula;

use App\Models\FormProcedureDetail;
use App\Models\FormProcedureDetailFormula;
use Encore\Admin\Actions\RowAction;
use Encore\Admin\Form;
use Illuminate\Database\Eloquent\Model;

class ListParameter extends RowAction
{
    public $name = 'List Parameter';

    public function handle(Model $model)
    {
        return $this->response()->success('Success message.')->refresh();
    }

    public function form(Model $model)
    {
        $form_procedure_detail_formula = FormProcedureDetailFormula::where('form_procedure_detail_id', $model->id)->orderBy('score', 'desc')->get();

        $this->modalLarge();
        $form_procedure_detail_formula->each(function ($item)
        {
            $this->text('parameter')->value($item->parameter)->readonly();
            $this->integer('score')->value($item->score)->readonly();
        });
    }

}