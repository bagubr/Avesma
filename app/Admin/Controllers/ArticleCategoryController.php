<?php

namespace App\Admin\Controllers;

use App\Models\ArticleCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ArticleCategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Kategori Artikel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ArticleCategory());

        $grid->filter(function($filter){
            $filter->disableIdFilter();
            $filter->like('nama', 'Nama');
        });

        $grid->disableRowSelector();
        $grid->disableColumnSelector();
        $grid->disableExport();
        $grid->disableFilter();
        $grid->quickSearch('name');

        $grid->column('id', __('ID'));
        $grid->column('name', __('Nama'));

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
        $show = new Show(ArticleCategory::findOrFail($id));

        $show->field('name', __('Nama'));
        
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
        $form = new Form(new ArticleCategory());

        $form->text('name', __('Nama'));
        $form->disableCreatingCheck();
        $form->disableEditingCheck();
        $form->disableViewCheck();

        return $form;
    }
}
