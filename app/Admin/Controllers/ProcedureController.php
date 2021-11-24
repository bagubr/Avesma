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

        
        $grid->quickSearch('title');
        $grid->column('title', __('Title'));
        $grid->column('image', __('Image'))->image();
        $grid->column('is_procedure', __('Is Procedure'))->bool();

        $grid->disableRowSelector();
        $grid->disableCreateButton();
        $grid->disableExport();
        $grid->disableFilter();
        $grid->disableColumnSelector();

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableDelete();
            $actions->disableView();
        });

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

        $show->field('title', __('Title'));
        $show->field('image', __('Image'))->image();
        $show->field('is_procedure', __('Image'))->bool();
        $show->panel()->tools(function ($tools)
        {
            $tools->disableList();
            $tools->disableEdit();
            $tools->disableDelete();
        });
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
        $form->switch('is_procedure', __('Is Procedure'));
        $form->disableCreatingCheck();
        $form->disableEditingCheck();
        $form->disableViewCheck();
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
        });
        return $form;
    }
}
