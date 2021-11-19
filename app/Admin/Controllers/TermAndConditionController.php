<?php

namespace App\Admin\Controllers;

use App\Models\TermAndCondition;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TermAndConditionController extends AdminController
{
    /**
     * Judul for current resource.
     *
     * @var string
     */
    protected $title = 'TermAndCondition';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TermAndCondition());
        if (TermAndCondition::all()->count() == 1) {
            $grid->disableCreateButton();
        }
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
            $actions->disableDelete();
        });

        $grid->column('title', __('Judul'));
        $grid->column('description', __('Deskripsi'));

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
        $show = new Show(TermAndCondition::findOrFail($id));

        $show->field('title', __('Judul'));
        $show->field('description', __('Deskripsi'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new TermAndCondition());

        $form->text('title', __('Judul'));
        $form->summernote('description', __('Deskripsi'));

        return $form;
    }
}
