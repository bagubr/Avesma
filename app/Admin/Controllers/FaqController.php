<?php

namespace App\Admin\Controllers;

use App\Models\Faq;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FaqController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Faq';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Faq());
        $grid->disableFilter();
        $grid->disableColumnSelector();
        $grid->disableExport();
        $grid->disablePagination();
        $grid->disableRowSelector();
        $grid->column('question', __('Question'));
        $grid->column('answer', __('Answer'));

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
        $show = new Show(Faq::findOrFail($id));

        $show->field('question', __('Question'));
        $show->field('answer', __('Answer'));
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
        $form = new Form(new Faq());

        $form->textarea('question', __('Question'));
        $form->textarea('answer', __('Answer'));

        return $form;
    }
}
