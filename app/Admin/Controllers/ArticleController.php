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

        $grid->column('article_category.name', __('Kategori Artikel'));
        $grid->column('title', __('Title'));
        $grid->column('description', __('Description'));
        $grid->column('image', __('Image'))->image();
        $grid->column('type', __('Type'));
        $grid->column('embed_link', __('Embed Link'))->link();
        $grid->column('file', __('File'));

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

        $show->field('id', __('Id'));
        $show->field('article_category_id', __('Article category'));
        $show->field('title', __('Title'));
        $show->field('description', __('Description'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('image', __('Image'));
        $show->field('embed_link', __('Embed Link'));
        $show->field('file', __('File'));

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
            Article::TYPE_FILE => Article::TYPE_FILE,
            Article::TYPE_VIDEO_EMBED => Article::TYPE_VIDEO_EMBED
        ])->required();
        $form->text('embed_link', __('Embed Link'));
        $form->file('file', __('File'));

        return $form;
    }
}
