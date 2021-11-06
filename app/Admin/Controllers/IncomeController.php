<?php

namespace App\Admin\Controllers;

use App\Models\Income;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class IncomeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Income';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Income());

        
        $grid->column('pond_detail_id', __('Pond detail id'));
        $grid->column('reported_at', __('Reported at'));
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
        $show = new Show(Income::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('pond_detail_id', __('Pond detail id'));
        $show->field('reported_at', __('Reported at'));
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
        $form = new Form(new Income());

        $form->number('pond_detail_id', __('Pond detail id'));
        $form->datetime('reported_at', __('Reported at'))->default(date('Y-m-d H:i:s'));

        return $form;
    }
}
