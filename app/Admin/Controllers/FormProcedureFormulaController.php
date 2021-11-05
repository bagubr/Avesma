<?php

namespace App\Admin\Controllers;

use App\Models\FormProcedureFormula;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FormProcedureFormulaController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'FormProcedureFormula';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FormProcedureFormula());

        
        $grid->column('procedure_id', __('Procedure id'));
        $grid->column('note', __('Note'));
        $grid->column('min_range', __('Min range'));
        $grid->column('max_range', __('Max range'));
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
        $show = new Show(FormProcedureFormula::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('procedure_id', __('Procedure id'));
        $show->field('note', __('Note'));
        $show->field('min_range', __('Min range'));
        $show->field('max_range', __('Max range'));
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
        $form = new Form(new FormProcedureFormula());

        $form->number('procedure_id', __('Procedure id'));
        $form->text('note', __('Note'));
        $form->decimal('min_range', __('Min range'));
        $form->decimal('max_range', __('Max range'));
        $form->decimal('score', __('Score'));

        return $form;
    }
}
