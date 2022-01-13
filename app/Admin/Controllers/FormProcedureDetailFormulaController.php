<?php

namespace App\Admin\Controllers;

use App\Models\FormProcedureDetail;
use App\Models\FormProcedureDetailFormula;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request;

class FormProcedureDetailFormulaController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'FormProcedureDetailFormula';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FormProcedureDetailFormula());

        
        $grid->column('form_procedure_detail_id', __('Form procedure detail id'));
        $grid->column('parameter', __('Parameter'));
        $grid->column('score', __('Score'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(FormProcedureDetailFormula::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('form_procedure_detail_id', __('Form procedure detail id'));
        $show->field('parameter', __('Parameter'));
        $show->field('score', __('Score'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
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

    public function getByFormProcedureDetail(HttpRequest $request)
    {
        $id = $request->get('q');
        
        return FormProcedureDetailFormula::where('form_procedure_detail_id', $id)->get(['id', 'form_procedure_detail_id', 'parameter', 'score']);
    }
}
