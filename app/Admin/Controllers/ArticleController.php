<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ArticleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Article';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Article());
        $grid->disableFilter();
        $grid->disableExport();
        $grid->disableRowSelector();
        $grid->disableColumnSelector();
        $grid->quickSearch('title', 'description', 'article_category.name', 'type');
        
        $grid->model()->orderBy('id', 'desc');
        $grid->column('article_category.name', __('Kategori Artikel'));
        $grid->column('title', __('Title'));
        $grid->column('description', __('Description'))->display(function ($description) {
            return $description;
        })->limit(30);
        $grid->column('image', __('Image'))->image();
        $grid->column('type', __('Type'));
        $grid->column('embed_link', __('Embed Link'))->link() ?? "Tidak Ada Link";
        $grid->column('file', __('File'))->link();

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
        $show = new Show(Article::findOrFail($id));
        $show->field('article_category_id', __('Article category'));
        $show->field('title', __('Title'));
        $show->field('description', __('Description'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('image', __('Image'));
        $show->field('embed_link', __('Embed Link'));
        $show->field('file', __('File'));
        $show->panel()->tools(function ($tools) {
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
        $form = new Form(new Article());

        $form->select('article_category_id', 'Kategori')->options(ArticleCategory::all()->pluck('name', 'id'))->required();

        $form->text('title', __('Judul'))->required();
        $form->summernote('description', __('Description'))->required();
        $form->image('image', __('Image'))->required();
        $form->select('type', __('Tipe'))->options([
            Article::TYPE_FILE => 'File',
            Article::TYPE_VIDEO_EMBED => 'Video Embed Youtube'
        ])
            ->when(Article::TYPE_FILE, function (Form $form) {
                $form->file('file', __('File'));
            })
            ->when(Article::TYPE_VIDEO_EMBED, function (Form $form) {
                $form->text('embed_link', __('Embed Link'));
            })
            ->required();
        $form->disableCreatingCheck();
        $form->disableViewCheck();
        $form->disableEditingCheck();
        return $form;
    }
}
