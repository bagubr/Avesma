<?php

namespace App\Admin\Controllers;

use App\Models\FishPrice;
use App\Models\FishSpecies;
use App\Models\Region;
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
    protected $title = 'Informasi Harga Ikan';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FishPrice());
        $grid->column('fish_species.name', __('Fish species'));
        $grid->column('price', __('Price'));
        $grid->column('reported_at', __('Reported at'));
        $grid->column('region.name', __('Wilayah'));
        $grid->column('is_verified', __('Is verified'))->bool();
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->disableColumnSelector();
        $grid->disableExport();
        $grid->disableFilter();
        $grid->disableRowSelector();

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

        $show->field('fish_species.name', __('Fish species'));
        $show->field('price', __('Price'));
        $show->field('reported_at', __('Reported at'));
        $show->field('region.name', __('Wilayah'));
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

        $form->select('fish_species_id', __('Fish species'))->options(FishSpecies::get()->pluck('name', 'id'));
        $form->currency('price', __('Price'))->symbol('Rp');
        $form->date('reported_at', __('Reported at'));
        $form->select('region_id', __('Wilayah'))->options(Region::get()->pluck('name', 'id'));
        $form->switch('is_verified', __('Is verified'));

        return $form;
    }
}
