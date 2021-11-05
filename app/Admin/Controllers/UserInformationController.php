<?php

namespace App\Admin\Controllers;

use App\Models\User;
use App\Models\UserInformation;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserInformationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Informasi Pembudidaya';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new UserInformation());

        $grid->filter(function($filter){

            // Remove the default id filter
            $filter->disableIdFilter();
        
            // Add a column filter
            $filter->like('nik', 'NIK');
        
        });
        $grid->column('user.name', __('Nama Pembudidaya'));
        $grid->column('nik', __('NIK'));
        $grid->column('ktp_photo', __('Ktp photo'))->image();
        $grid->column('ktp_selfie_photo', __('Ktp selfie photo'))->image();
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
        $show = new Show(UserInformation::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('nik', __('Nik'));
        $show->field('ktp_photo', __('Ktp photo'));
        $show->field('ktp_selfie_photo', __('Ktp selfie photo'));
        $show->field('deleted_at', __('Deleted at'));
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
        $form = new Form(new UserInformation());

        // $form->number('user_id', __('User id'));
        $form->select('user_id', __('Pembudidaya'))->options(User::all()->pluck('name','id'));
        $form->text('nik', __('NIK'));
        $form->image('ktp_photo', __('KTP photo'));
        $form->image('ktp_selfie_photo', __('KTP selfie photo'));

        return $form;
    }
}
