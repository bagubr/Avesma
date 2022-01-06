<?php

namespace App\Admin\Controllers;

use App\Models\FishCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FishCategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Jenis Kultivan';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FishCategory());
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
            $actions->disableDelete();
        });
        $grid->disableExport();
        $grid->disablePagination();
        $grid->disableRowSelector();
        $grid->disableColumnSelector();
        $grid->disableFilter();
        $grid->disableCreateButton();
        $grid->quickSearch('name');
        $grid->column('name', __('Nama'));
        $grid->column('image', __('Image'))->image();

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
        $show = new Show(FishCategory::findOrFail($id));

        $show->field('name', __('Nama'));
        $show->field('image', __('Image'))->image();
        $show->field('image', __('Image'))->image();

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new FishCategory());

        $form->text('name', __('Nama'));
        $form->image('image', __('Image'));
        $form->disableCreatingCheck();
        $form->disableEditingCheck();
        $form->disableViewCheck();
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
            $tools->disableList();
        });
        return $form;
    }
}
