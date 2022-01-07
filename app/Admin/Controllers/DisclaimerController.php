<?php

namespace App\Admin\Controllers;

use App\Models\Disclaimer;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DisclaimerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Disclaimer';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Disclaimer());
        $grid->disableFilter();
        $grid->disableExport();
        $grid->disableColumnSelector();
        if (Disclaimer::all()->count() == 1) {
            $grid->disableCreateButton();
        }
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableDelete();
            $actions->disableView();
        });
        $grid->disableBatchActions();
        $grid->column('description', __('Description'))->display(function ($description)
        {
            return $description;
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
        $show = new Show(Disclaimer::findOrFail($id));

        $show->field('description', __('Description'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Disclaimer());

        $form->summernote('description', __('Description'));

        return $form;
    }
}
