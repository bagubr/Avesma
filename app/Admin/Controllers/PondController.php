<?php

namespace App\Admin\Controllers;

use App\Models\FishSpecies;
use App\Models\Pond;
use App\Models\PondDetail;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PondController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Pond';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Pond());

        $grid->disableFilter();
        $grid->quickSearch('name');
        $grid->column('name', __('Nama Kolam'));
        $grid->column('user.name', __('User'));
        $grid->column('pond_detail.pond_spesies', __('Jenis Ikan'));
        $grid->column('pond_detail.seed_count', __('Jumlah Pakan'));
        $grid->column('area', __('Luas Area'))->display(function ($area)
        {
            return $area. ' m<sup>2</sup>';
        });
        $grid->column('latitude', __('Latitude'));
        $grid->column('longitude', __('Longitude'));
        $grid->column('address', __('Address'));
        $grid->column('status', __('Status'));
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
        $show = new Show(Pond::findOrFail($id));

        $show->field('user.name', __('User'));
        $show->field('pond_detail.pond_spesies', __('Jenis Ikan'));
        $show->field('pond_detail.seed_count', __('Jumlah Pakan'));
        $show->field('name', __('Nama Kolam'));
        $show->field('area', __('Luas Area'));
        $show->field('latitude', __('Latitude'));
        $show->field('longitude', __('Longitude'));
        $show->field('address', __('Address'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->pond_harvest('Hasil Panen', function ($pond_harvests) {

            $pond_harvests->setResource('/admin/pond-harvests');

            $pond_harvests->weight();
            $pond_harvests->image()->image();
            $pond_harvests->harvest_at();
            $pond_harvests->description();
            $pond_harvests->status();
            $pond_harvests->disableCreateButton();
            $pond_harvests->disableFilter();
            $pond_harvests->disableExport();
            $pond_harvests->disableColumnSelector();
            $pond_harvests->disablePagination();
            $pond_harvests->disableRowSelector();
            $pond_harvests->disableActions();
            // $pond_harvests->actions(function (Grid\Displayers\Actions $actions) {
            //     $actions->disableDelete();
            // });
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Pond());

        $form->select('user_id', __('User'))->options(User::get()->pluck('name', 'id'))->rules('required');
        $form->text('name', __('Nama Kolam'))->rules('required');
        $form->select('pond_detail.fish_species_id', 'Jenis Ikan')->options(FishSpecies::get()->pluck('name', 'id'))->rules('required');
        $form->decimal('area', __('Lusa Area'))->rules('required');
        $form->latlong('latitude', 'longitude', 'Latitude - Longitude')->default(['lat' => -6.974309, 'lng' => 110.426674])->zoom(11)->rules('required');
        $form->text('address', __('Address'))->rules('required');
        $form->text('description', __('Description'))->rules('required');
        $form->number('pond_detail.seed_count', __('Jumlah Pakan'))->rules('required');

        // $form->saved(function (Form $form) use ()
        // {
        //     $pond_detail = new PondDetail();
        //     $fish_species_id = $form->model()->fish_species_id;
        //     $pond_detail->fish_species_id = $fish_species_id;
        //     $seed_count = $form->model()->seed_count;
        //     $pond_detail->seed_count = $seed_count;
        //     $pond_detail->pond_id = $form->model()->id;
        //     $pond_detail->save();
        // });
        // $form->saving(function (Form $form)
        // {
        //     $form->ignore('fish_species_id', 'seed_count');
        // });
        
        return $form;
    }
}
