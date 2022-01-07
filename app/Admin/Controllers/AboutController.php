<?php

namespace App\Admin\Controllers;

use App\Models\About;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AboutController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Beranda';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new About());
        if (About::all()->count() == 1) {
            $grid->disableCreateButton();
        }
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
            $actions->disableDelete();
        });

        $grid->disableColumnSelector();
        $grid->disableBatchActions();
        $grid->disableExport();
        $grid->disableFilter();

        $grid->column('description_indo', __('Deskripsi Indonesia'))->display(function ()
        {
            return $this->description_indo;
        });
        $grid->column('description_english', __('Deskripsi Inggris'))->display(function ()
        {
            return $this->description_english;
        });
        $grid->column('video_url', __('Video url'))->link();
        $grid->column('vision', __('Vision'))->display(function ()
        {
            return $this->vision;
        });
        $grid->column('mission', __('Mission'))->display(function ()
        {
            return $this->mission;
        });
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
        $show = new Show(About::findOrFail($id));

        $show->field('description_indo', __('Deskripsi indo'));
        $show->field('description_english', __('Deskripsi english'));
        $show->field('video_url', __('Video url'))->link();
        $show->field('vision', __('Vision'));
        $show->field('mission', __('Mission'));
        $show->field('image', __('Image'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new About());

        $form->summernote('description_indo', __('Deskripsi indo'));
        $form->summernote('description_english', __('Deskripsi english'));
        $form->url('video_url', __('Video url'));
        $form->summernote('vision', __('Vision'));
        $form->summernote('mission', __('Mission'));
        $form->image('image', __('Image'));

        return $form;
    }
}
