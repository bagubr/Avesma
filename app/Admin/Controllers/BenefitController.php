<?php

namespace App\Admin\Controllers;

use App\Models\Benefit;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BenefitController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Benefit';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Benefit());
        if (Benefit::all()->count() == 4) {
            $grid->disableCreateButton();
            $grid->actions(function ($actions) {
                $actions->disableDelete();
            });
        }
        $grid->disableFilter();
        $grid->disableExport();
        $grid->disableColumnSelector();
        $grid->disableRowSelector();
        $grid->disablePagination();
        $grid->column('id', __('ID'));
        $grid->column('title', __('Judul'));
        $grid->column('description', __('Deskripsi'));
        $grid->column('image', __('Gambar'))->image();

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
        $show = new Show(Benefit::findOrFail($id));

        $show->field('title', __('Judul'));
        $show->field('description', __('Deskripsi'));
        $show->field('image', __('Gambar'))->image();

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Benefit());

        $form->text('title', __('Judul'))->required();
        $form->textarea('description', __('Deskripsi'))->required();
        $form->image('image', __('Gambar'))->required();

        return $form;
    }
}
