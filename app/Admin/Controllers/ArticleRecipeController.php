<?php

namespace App\Admin\Controllers;

use App\Models\ArticleRecipe;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ArticleRecipeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ArticleRecipe';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ArticleRecipe());
        $grid->disableFilter();
        $grid->disableExport();
        $grid->disableRowSelector();
        $grid->disableColumnSelector();
        $grid->quickSearch('title', 'description', 'type');
        $grid->column('title', __('Title'));
        $grid->column('description', __('Description'))->display(function ($description)
        {
            return $description;
        });
        $grid->column('image', __('Image'))->image();
        $grid->column('type', __('Type'));
        $grid->column('embed_link', __('Embed Link'))->link();
        $grid->column('file', __('File'));
        $grid->column('created_at', __('Created'));

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
        $show = new Show(ArticleRecipe::findOrFail($id));

        $show->field('title', __('Title'));
        $show->field('description', __('Description'))->unescape()->as(function ($description) {
            return $description;
        });
        $show->field('image', __('Image'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('image', __('Image'));
        $show->field('embed_link', __('Embed Link'));
        $show->field('file', __('File'));

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
        $form = new Form(new ArticleRecipe());
        $form->text('title', __('Judul'))->required()->help('max 255 character');
        $form->summernote('description', __('Description'))->required()->help('max 1000 character');
        $form->image('image', __('Image'))->required();
        $form->select('type', __('Tipe'))->options([
            ArticleRecipe::TYPE_FILE => 'File',
            ArticleRecipe::TYPE_VIDEO_EMBED => 'Video Embed Youtube'
        ])
        ->when(ArticleRecipe::TYPE_FILE, function (Form $form)
        {
            $form->file('file', __('File'));
        })
        ->when(ArticleRecipe::TYPE_VIDEO_EMBED, function (Form $form)
        {
            $form->text('embed_link', __('Embed Link'));
        })
        ->required();
        $form->disableCreatingCheck();
        $form->disableViewCheck();
        $form->disableEditingCheck();

        return $form;
    }
}
