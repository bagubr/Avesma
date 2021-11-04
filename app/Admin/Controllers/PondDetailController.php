<?php

namespace App\Admin\Controllers;

use App\Models\PondDetail;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PondDetailController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'PondDetail';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PondDetail());

        $grid->column('id', __('Id'));
        $grid->column('pond_id', __('Pond id'));
        $grid->column('fish_species_id', __('Fish species id'));
        $grid->column('seed_count', __('Seed count'));
        $grid->column('seed_size', __('Seed size'));
        $grid->column('feed_type', __('Feed type'));
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
        $show = new Show(PondDetail::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('pond_id', __('Pond id'));
        $show->field('fish_species_id', __('Fish species id'));
        $show->field('seed_count', __('Seed count'));
        $show->field('seed_size', __('Seed size'));
        $show->field('feed_type', __('Feed type'));
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
        $form = new Form(new PondDetail());

        $form->number('pond_id', __('Pond id'));
        $form->number('fish_species_id', __('Fish species id'));
        $form->number('seed_count', __('Seed count'));
        $form->decimal('seed_size', __('Seed size'));
        $form->text('feed_type', __('Feed type'));

        return $form;
    }
}
