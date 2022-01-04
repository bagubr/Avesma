<?php

namespace App\Admin\Controllers;

use App\Models\SocialMedia;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SocialMediaController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Social Media';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SocialMedia());
        
        $grid->disableExport();
        $grid->disableRowSelector();
        $grid->disableFilter();
        $grid->disableColumnSelector();
        $grid->quickSearch('name', 'url');

        $grid->column('name', __('Nama Social Media'));
        $grid->column('url', __('Link Sosial Meida'));
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
        $show = new Show(SocialMedia::findOrFail($id));

        $show->field('name', __('Nama Social Media'));
        $show->field('url', __('Link Sosial Media'));
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
        $form = new Form(new SocialMedia());

        $form->text('name', __('Nama Social Media'));
        $form->url('url', __('Link Sosial Media'));
        $form->image('image', __('Image'));
        $form->disableCreatingCheck();
        $form->disableEditingCheck();
        $form->disableViewCheck();

        return $form;
    }
}
