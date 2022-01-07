<?php

namespace App\Admin\Controllers;

use App\Models\Contact;
use App\Models\Region;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ContactController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Contact';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Contact());
        $grid->disableFilter();
        $grid->disableRowSelector();
        $grid->disableExport();
        $grid->disableColumnSelector();
        $grid->disablePagination();
        $grid->quickSearch('name', 'content');
        $grid->column('name', __('Nama'));
        $grid->column('content', __('Konten'));
        $grid->column('icon', __('Icon'))->image();
        $grid->column('type', __('Tipe'));
        $grid->column('region.name', __('Wilayah'));

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
        $show = new Show(Contact::findOrFail($id));

        $show->field('name', __('Nama'));
        $show->field('content', __('Konten'));
        $show->field('icon', __('Icon'));
        $show->field('type', __('Tipe'));
        $show->field('region.name', __('Wilayah'));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Contact());

        $form->text('name', __('Nama'))->required();
        $form->select('type', __('Tipe'))->options(Contact::TYPE)->required();
        $form->text('content', __('Konten'))->required();
        $form->file('icon', __('Icon'))->required();
        $form->select('region_id', __('Wilayah'))->options(Region::all()->pluck('name', 'id'));

        return $form;
    }
}
