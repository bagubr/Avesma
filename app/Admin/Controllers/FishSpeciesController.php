<?php

namespace App\Admin\Controllers;

use App\Models\FishCategory;
use App\Models\FishSpecies;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FishSpeciesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Spesies Ikan';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FishSpecies());

        $grid->filter(function($filter){
            $filter->disableIdFilter();
            $filter->like('name', 'Name');
            $filter->like('fish_category.name', 'Jenis Kultivan');
        });

        $grid->quickSearch('name', 'fish_category.name');

        $grid->disableExport();

        $grid->column('name', __('Nama'));
        $grid->column('fish_category.name', __('Jenis Kultivan'));
        $grid->column('image', __('Image'))->image();

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
        $show = new Show(FishSpecies::findOrFail($id));

        $show->field('name', __('Nama'));
        $show->field('image', __('Image'))->image();

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new FishSpecies());

        $form->text('name', __('Nama'));
        $form->select('fish_category_id', __('Jenis Kultivan'))->options(FishCategory::all()->pluck('name','id'));
        $form->image('image', __('Image'));

        return $form;
    }
}
