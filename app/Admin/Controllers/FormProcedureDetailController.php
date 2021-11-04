<?php

namespace App\Admin\Controllers;

use App\Models\FormProcedureDetail;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FormProcedureDetailController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'FormProcedureDetail';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FormProcedureDetail());

        $grid->column('id', __('Id'));
        $grid->column('form_procedure_id', __('Form procedure id'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('name', __('Name'));

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
        $show = new Show(FormProcedureDetail::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('form_procedure_id', __('Form procedure id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('name', __('Name'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new FormProcedureDetail());

        $form->number('form_procedure_id', __('Form procedure id'));
        $form->text('name', __('Name'));

        return $form;
    }
}
