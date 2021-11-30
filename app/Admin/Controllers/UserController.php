<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\User\Restore;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Actions\User\StarUser;
use App\Models\Region;
use App\Models\UserInformation;
use Encore\Admin\Grid\Displayers\Actions;
use Illuminate\Http\Request;

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

        $grid->filter(function($filter){
            $filter->disableIdFilter();
            $filter->like('name', 'Name');
            $filter->like('email', 'Email');
            $filter->like('phone', 'Phone');
            $filter->scope('trashed', 'Recycle Bin')->onlyTrashed();
        });
        $grid->quickSearch('name', 'email', 'phone');
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('phone', __('Phone'));
        $grid->column('gender', __('Gender'));
        $grid->column('region.name', __('Wilayah'));
        $grid->column('birth_date', __('Birth date'));
        $grid->column('is_verified', __('Is verified'))->bool();
        $grid->column('created_at', __('Member Since'));
        $grid->column('updated_at', __('Updated at'));
        $grid->disableExport();
        if (request('_scope_') == 'trashed'){
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableDelete();
            $actions->disableView();
            $actions->disableEdit();
            $actions->add(new Restore());
        });
        }
        
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
        $show->field('region.name', __('Wilayah'));
        $show->field('created_at', __('Member Since'));
        
        $show->user_information('User Information', function ($user_information) {

            $user_information->setResource('/admin/user-informations');
            $user_information->nik();
            $user_information->ktp_photo()->image();
            $user_information->ktp_selfie_photo()->image();
            $user_information->panel()->tools(function ($tools)
            {
                $tools->disableList();
                $tools->disableEdit();
                $tools->disableDelete();
            });
        });
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
        $form = new Form(new User());
        $form->text('name', __('Name'))->required();
        $form->email('email', __('Email'))->required();
        $form->mobile('phone', __('Phone'))->options(['mask' => '9999999999999'])->required()->value($form->model()->phone);
        $form->select('gender', __('Jenis Kelamin'))->options(['', 'Pria' => 'Pria', 'Wanita' => 'Wanita'])->required();
        $form->date('birth_date', __('Ulang Tahun'))->default(date('Y-m-d'))->required();
        $form->textarea('address', __('Address'))->required();
        $form->switch('is_verified', __('Is verified'));

        $data = Region::get()->pluck('name', 'id');
        $form->select('region_id', __('Wilayah'))->options($data);
        $form->disableCreatingCheck();
        $form->disableEditingCheck();
        $form->disableViewCheck();
         $form->saving(function (Form $form)
        {
            $form->phone = '+'.preg_replace('/\D/', '', $form->phone);
        });
        // $form->tab('User', function ($form) {

        //     $form->text('name', __('Name'))->required();
        //     $form->email('email', __('Email'))->required();
        //     $form->mobile('phone', __('Phone'))->options(['mask' => '999999999999'])->required();
        //     // $form->text('gender', __('Gender'))->required();
        //     $form->select('gender', __('Jenis Kelamin'))->options(['', 'Pria' => 'Pria', 'Wanita' => 'Wanita'])->required();
        //     $form->date('birth_date', __('Ulang Tahun'))->default(date('Y-m-d'))->required();
        //     $form->textarea('address', __('Address'))->required();
        //     $form->switch('is_verified', __('Is verified'));

            
        // })->tab('User Information', function ($form) {
        //     $form2 = new Form(new User());
        //     $form2->text('nik');
        //     $form2->image('ktp_photo');
        //     $form2->image('ktp_selfie_photo');
        //     $data = [
        //         'PENDING' => 'Pending',
        //         'CONFIRMED' => 'Confirmed',
        //         'DECLINE' => 'Decline',
        //     ];
        //     $form2->select('status', __('Status'))->options($data);
            
        // });

        return $form;
    }
}
