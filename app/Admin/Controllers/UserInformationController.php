<?php

namespace App\Admin\Controllers;

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
    protected $title = 'UserInformation';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new UserInformation());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('nik', __('Nik'));
        $grid->column('ktp_photo', __('Ktp photo'));
        $grid->column('ktp_selfie_photo', __('Ktp selfie photo'));
        $grid->column('deleted_at', __('Deleted at'));
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

        $form->number('user_id', __('User id'));
        $form->text('nik', __('Nik'));
        $form->text('ktp_photo', __('Ktp photo'));
        $form->text('ktp_selfie_photo', __('Ktp selfie photo'));

        return $form;
    }
}
