<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\UserInformation\Confirmation;
use App\Admin\Actions\UserInformation\Decline;
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
            $filter->disableIdFilter();
            $filter->like('user.name', 'Name');
            $filter->like('nik', 'NIK');
        });
        $grid->disableExport();

        $grid->quickSearch('user.name', 'nik');
        $grid->column('user.name', __('Nama Pembudidaya'));
        $grid->column('nik', __('NIK'));
        $grid->column('ktp_photo', __('Ktp photo'))->image();
        $grid->column('ktp_selfie_photo', __('Ktp selfie photo'))->image();
        $grid->column('status', __('Status'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->actions(function ($actions) {
            $actions->add(new Confirmation);
            $actions->add(new Decline);
        });

        $grid->model()->orderBy('id', 'desc');
        $grid->model()->where('status', 'CONFIRMED');

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

        // $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('nik', __('Nik'));
        $show->field('ktp_photo', __('Ktp photo'));
        $show->field('ktp_selfie_photo', __('Ktp selfie photo'));
        // $show->field('deleted_at', __('Deleted at'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
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
        $form = new Form(new UserInformation());

        // $form->number('user_id', __('User id'));
        $form->select('user_id', __('Pembudidaya'))->options(User::all()->pluck('name','id'));
        $form->text('nik', __('NIK'));
        $form->image('ktp_photo', __('KTP photo'));
        $form->image('ktp_selfie_photo', __('KTP selfie photo'));
        $data = [
                'PENDING' => 'Pending',
                'CONFIRMED' => 'Confirmed',
                'DECLINE' => 'Decline',
            ];
        $form->select('status', __('Status'))->options($data);
        $form->disableCreatingCheck();
        $form->disableEditingCheck();
        $form->disableViewCheck();
        return $form;
    }
}
