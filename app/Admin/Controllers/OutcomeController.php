<?php

namespace App\Admin\Controllers;

use App\Models\Outcome;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OutcomeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Outcome';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Outcome());

        $grid->column('id', __('Id'));
        $grid->column('pond_detail_id', __('Pond detail id'));
        $grid->column('outcome_setting_id', __('Outcome setting id'));
        $grid->column('name', __('Name'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('total_price', __('Total price'));

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
        $show = new Show(Outcome::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('pond_detail_id', __('Pond detail id'));
        $show->field('outcome_setting_id', __('Outcome setting id'));
        $show->field('name', __('Name'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('total_price', __('Total price'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Outcome());

        $form->number('pond_detail_id', __('Pond detail id'));
        $form->number('outcome_setting_id', __('Outcome setting id'));
        $form->text('name', __('Name'));
        $form->number('total_price', __('Total price'));

        return $form;
    }
}
