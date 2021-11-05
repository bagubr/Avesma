<?php

namespace App\Admin\Controllers;

use App\Models\ArticleProcedure;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ArticleProcedureController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ArticleProcedure';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ArticleProcedure());

        
        $grid->column('procedure_id', __('Procedure id'));
        $grid->column('title', __('Title'));
        $grid->column('description', __('Description'));
        $grid->column('file', __('File'));
        $grid->column('type', __('Type'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('image', __('Image'));

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
        $show = new Show(ArticleProcedure::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('procedure_id', __('Procedure id'));
        $show->field('title', __('Title'));
        $show->field('description', __('Description'));
        $show->field('file', __('File'));
        $show->field('type', __('Type'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
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
        $form = new Form(new ArticleProcedure());

        $form->number('procedure_id', __('Procedure id'));
        $form->text('title', __('Title'));
        $form->textarea('description', __('Description'));
        $form->file('file', __('File'));
        $form->text('type', __('Type'));
        $form->image('image', __('Image'));

        return $form;
    }
}
