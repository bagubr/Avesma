<?php

namespace App\Admin\Controllers;

use App\Models\FormProcedureDetailInput;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FormProcedureDetailInputController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'FormProcedureDetailInput';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FormProcedureDetailInput());

        
        $grid->column('form_procedure_detail_id', __('Pertanyaan'));
        $grid->column('form_procedure_detail_formula_id', __('Form procedure detail formula id'));
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
        $show = new Show(FormProcedureDetailInput::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('form_procedure_detail_id', __('Form procedure detail id'));
        $show->field('form_procedure_detail_formula_id', __('Form procedure detail formula id'));
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
        $form = new Form(new FormProcedureDetailInput());

        $form->number('form_procedure_detail_id', __('Pertanyaan'));
        $form->number('form_procedure_detail_formula_id', __('Form procedure detail formula id'));
        $form->decimal('score', __('Score'));

        return $form;
    }
}
