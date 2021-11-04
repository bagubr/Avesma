<?php

namespace App\Admin\Controllers;

use App\Models\Procedure;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProcedureController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Procedure';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Procedure());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('image', __('Image'));

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
        $show = new Show(Procedure::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('image', __('Image'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Procedure());

        $form->text('title', __('Title'));
        $form->image('image', __('Image'));

        return $form;
    }
}