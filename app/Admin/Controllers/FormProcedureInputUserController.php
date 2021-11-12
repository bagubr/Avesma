<?php

namespace App\Admin\Controllers;

use App\Models\FormProcedureInputUser;
use App\Models\PondDetail;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FormProcedureInputUserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'FormProcedureInputUser';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FormProcedureInputUser());

        $grid->column('user.name', __('User Name'));
        $grid->column('pond_detail.pond_name', __('Pond detail'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('reported_at', __('Reported at'));

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
        $show = new Show(FormProcedureInputUser::findOrFail($id));

        $show->field('user_id', __('User id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('pond_detail_id', __('Pond detail id'));
        $show->field('reported_at', __('Reported at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new FormProcedureInputUser());
        $users = User::get()->pluck('name', 'id');
        $form->select('user_id', __('User name'))->options($users);
        $form->date('reported_at', __('Reported at'))->default(date('Y-m-d'));

        return $form->saving(function (Form $form)
        {
            $form->when($form, function (Form $form) {
                $pond_details = PondDetail::whereHas('pond', function ($query) use ($form)
                {
                    $query->where('user_id', $form->user_id);
                })->get()->pluck('pond_name', 'id');
                $form->select('pond_detail_id', __('Kolam User'))->options($pond_details);
            });
        });
    }
}
