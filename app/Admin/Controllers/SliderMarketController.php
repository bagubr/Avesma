<?php

namespace App\Admin\Controllers;

use App\Models\SliderMarket;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SliderMarketController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'SliderMarket';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SliderMarket());
        $grid->disableFilter();
        $grid->disableColumnSelector();
        $grid->disableExport();
        $grid->disableRowSelector();
        $grid->disablePagination();
        $grid->column('image', __('Image'))->image();
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
        $show = new Show(SliderMarket::findOrFail($id));
        $show->field('image', __('Image'))->image();
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
        $form = new Form(new SliderMarket());

        $form->image('image', __('Image'))->help('Disarankan menggunakan ukuran 1440px x 500px');;

        return $form;
    }
}
