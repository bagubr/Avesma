<?php

namespace App\Admin\Controllers;

use App\Models\OutcomeDetail;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OutcomeDetailController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'OutcomeDetail';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new OutcomeDetail());

        $grid->column('id', __('Id'));
        $grid->column('outcome_setting_id', __('Outcome setting id'));
        $grid->column('nominal', __('Nominal'));
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
        $show = new Show(OutcomeDetail::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('outcome_setting_id', __('Outcome setting id'));
        $show->field('nominal', __('Nominal'));
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
        $form = new Form(new OutcomeDetail());

        $form->number('outcome_setting_id', __('Outcome setting id'));
        $form->number('nominal', __('Nominal'));

        return $form;
    }
}
