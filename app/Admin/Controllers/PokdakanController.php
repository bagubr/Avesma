<?php

namespace App\Admin\Controllers;

use App\Models\Pokdakan;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PokdakanController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Pokdakan';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Pokdakan());
        $grid->filter(function($filter){
            $filter->disableIdFilter();
            $filter->like('name', 'name');
            $filter->like('address', 'address');
        });
        $grid->quickSearch('name', 'address');
        
        $grid->column('name', __('Name'));
        $grid->column('address', __('Address'));
        $grid->column('latitude', __('Latitude'));
        $grid->column('longitude', __('Longitude'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->disableExport();

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
        $show = new Show(Pokdakan::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('address', __('Address'));
        $show->field('latitude', __('Latitude'));
        $show->field('longitude', __('Longitude'));
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
        $form = new Form(new Pokdakan());

        $form->text('name', __('Name'));
        $form->text('address', __('Address'));
        $form->latlong('latitude', 'longitude', 'Latitude - Longitude')->default(['lat' => -6.974309, 'lng' => 110.426674])->zoom(11);

        return $form;
    }
}
