<?php

namespace App\Admin\Controllers;

use App\Models\PondHarvest;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PondHarvestController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'PondHarvest';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PondHarvest());

        $grid->column('id', __('Id'));
        $grid->column('pond_detail_id', __('Pond detail id'));
        $grid->column('weight', __('Weight'));
        $grid->column('image', __('Image'));
        $grid->column('harvest_at', __('Harvest at'));
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
        $show = new Show(PondHarvest::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('pond_detail_id', __('Pond detail id'));
        $show->field('weight', __('Weight'));
        $show->field('image', __('Image'));
        $show->field('harvest_at', __('Harvest at'));
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
        $form = new Form(new PondHarvest());

        $form->number('pond_detail_id', __('Pond detail id'));
        $form->decimal('weight', __('Weight'));
        $form->image('image', __('Image'));
        $form->date('harvest_at', __('Harvest at'))->default(date('Y-m-d'));

        return $form;
    }
}
