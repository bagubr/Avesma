<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Pembudidaya';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        // 
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('phone', __('Phone'));
        $grid->column('gender', __('Gender'));
        $grid->column('birth_date', __('Birth date'));
        $grid->column('address', __('Address'));
        $grid->column('is_verified', __('Is verified'));
        // $grid->column('deleted_at', __('Deleted at'));
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
        $show = new Show(User::findOrFail($id));

        // $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('phone', __('Phone'));
        $show->field('gender', __('Gender'));
        $show->field('birth_date', __('Birth date'));
        $show->field('address', __('Address'));
        $show->field('is_verified', __('Is verified'));
        // $show->field('deleted_at', __('Deleted at'));
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
        $form = new Form(new User());

        $form->text('name', __('Name'))->required();
        $form->email('email', __('Email'))->required();
        $form->mobile('phone', __('Phone'))->options(['mask' => '999999999999'])->required();
        // $form->text('gender', __('Gender'))->required();
        $form->select('gender', __('Jenis Kelamin'))->options(['', 'Pria' => 'Pria', 'Wanita' => 'Wanita'])->required();
        $form->date('birth_date', __('Ulang Tahun'))->default(date('Y-m-d'))->required();
        $form->text('address', __('Address'))->required();
        $form->switch('is_verified', __('Is verified'));

        return $form;
    }
}
