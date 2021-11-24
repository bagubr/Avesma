<?php

namespace App\Admin\Controllers;

use App\Models\OutcomeCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OutcomeCategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Kategori Pengeluaran';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new OutcomeCategory());

        $grid->disableFilter();
        $grid->disableColumnSelector();
        $grid->disableExport();
        $grid->disableRowSelector();
        $grid->quickSearch('name');
        $grid->column('name', __('Name'));
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
        $show = new Show(OutcomeCategory::findOrFail($id));
        $show->field('name', __('Name'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->panel()->tools(function (Show\Tools $tool)
        {
            $tool->disableDelete();
            $tool->disableEdit();
            $tool->disableList();
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
        $form = new Form(new OutcomeCategory());

        $form->text('name', __('Name'));
        $form->disableCreatingCheck();
        $form->disableEditingCheck();
        $form->disableViewCheck();

        return $form;
    }
}
