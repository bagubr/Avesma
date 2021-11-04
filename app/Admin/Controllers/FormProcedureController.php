<?php

namespace App\Admin\Controllers;

use App\Models\FormProcedure;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FormProcedureController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'FormProcedure';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FormProcedure());

        $grid->column('id', __('Id'));
        $grid->column('procedure_id', __('Procedure id'));
        $grid->column('fish_species_id', __('Fish species id'));
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
        $show = new Show(FormProcedure::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('procedure_id', __('Procedure id'));
        $show->field('fish_species_id', __('Fish species id'));
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
        $form = new Form(new FormProcedure());

        $form->number('procedure_id', __('Procedure id'));
        $form->number('fish_species_id', __('Fish species id'));

        return $form;
    }
}
