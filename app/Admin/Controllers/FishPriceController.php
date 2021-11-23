<?php

namespace App\Admin\Controllers;

use App\Models\FishPrice;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FishPriceController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'FishPrice';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FishPrice());

        $grid->column('id', __('Id'));
        $grid->column('fish_species_id', __('Fish species id'));
        $grid->column('price', __('Price'));
        $grid->column('reported_at', __('Reported at'));
        $grid->column('region_id', __('Region id'));
        $grid->column('is_verified', __('Is verified'));
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
        $show = new Show(FishPrice::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('fish_species_id', __('Fish species id'));
        $show->field('price', __('Price'));
        $show->field('reported_at', __('Reported at'));
        $show->field('region_id', __('Region id'));
        $show->field('is_verified', __('Is verified'));
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
        $form = new Form(new FishPrice());

        $form->number('fish_species_id', __('Fish species id'));
        $form->number('price', __('Price'));
        $form->text('reported_at', __('Reported at'));
        $form->number('region_id', __('Region id'));
        $form->switch('is_verified', __('Is verified'));

        return $form;
    }
}
