<?php

namespace App\Admin\Controllers;

use App\Models\ArticleProcedure;
use App\Models\Procedure;
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
    protected $title = 'Artikel SOP';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ArticleProcedure());

        $grid->disableFilter();
        $grid->disableExport();
        $grid->disableRowSelector();
        $grid->disableColumnSelector();
        $grid->quickSearch('title', 'description', 'type');
        $grid->column('procedure.title', __('SOP'));
        $grid->column('title', __('Title'));
        $grid->column('description', __('Description'));
        $grid->column('type', __('Type'));
        $grid->column('file', __('File'))->downloadable();
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
        $show = new Show(ArticleProcedure::findOrFail($id));
        $show->field('procedure_id', __('Procedure id'));
        $show->field('title', __('Title'));
        $show->field('description', __('Description'));
        $show->field('file', __('File'));
        $show->field('type', __('Type'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('image', __('Image'));

        
        $show->panel()->tools(function ($tools)
        {
            $tools->disableList();
            $tools->disableEdit();
            $tools->disableDelete();
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
        $form = new Form(new ArticleProcedure());

        $form->select('procedure_id', __('Procedure'))->options(Procedure::all()->pluck('title', 'id'))->required();
        $form->text('title', __('Title'));
        $form->summernote('description', __('Description'));
        $form->file('file', __('File'));
        $form->select('type', __('Tipe'))->options([
            ArticleProcedure::TYPE_FILE => 'File',
            ArticleProcedure::TYPE_VIDEO_EMBED => 'Video Embed Youtube'
        ])
        ->when(ArticleProcedure::TYPE_FILE, function (Form $form)
        {
            $form->file('file', __('File'));
        })
        ->when(ArticleProcedure::TYPE_VIDEO_EMBED, function (Form $form)
        {
            $form->text('embed_link', __('Embed Link'));
        })
        ->required();
        $form->image('image', __('Image'));
        $form->disableCreatingCheck();
        $form->disableViewCheck();
        $form->disableEditingCheck();
        return $form;
    }
}
