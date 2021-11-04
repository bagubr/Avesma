<?php

namespace App\Admin\Controllers;

use App\Models\IncomeDetail;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class IncomeDetailController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'IncomeDetail';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new IncomeDetail());

        $grid->column('id', __('Id'));
        $grid->column('income_id', __('Income id'));
        $grid->column('name', __('Name'));
        $grid->column('weight', __('Weight'));
        $grid->column('price', __('Price'));
        $grid->column('total_price', __('Total price'));
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
        $show = new Show(IncomeDetail::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('income_id', __('Income id'));
        $show->field('name', __('Name'));
        $show->field('weight', __('Weight'));
        $show->field('price', __('Price'));
        $show->field('total_price', __('Total price'));
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
        $form = new Form(new IncomeDetail());

        $form->number('income_id', __('Income id'));
        $form->text('name', __('Name'));
        $form->decimal('weight', __('Weight'));
        $form->number('price', __('Price'));
        $form->number('total_price', __('Total price'));

        return $form;
    }
}
