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

        $grid->column('id', __('Id'));
        $grid->column('user.name', __('User Name'));
        $grid->column('pond_detail.pond_spesies', __('Kolam'));
        $grid->column('reported_at', __('Reported at'));
        $grid->column('created_at', __('Created at'));

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

        $show->field('id', __('Id'));
        $show->field('user.name', __('User Name'));
        $show->field('pond_detail.pond_spesies', __('Kolam'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('reported_at', __('Reported at'));

        $show->form_procedure_detail_input('Isian', function ($procedure) {

            $procedure->setResource('/admin/form-procedure-detail-inputs');
            $procedure->form_procedure_detail_id('Pertanyaan');
            $procedure->form_procedure_detail_formula_id('Pilihan');
            $procedure->score();
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
        $form = new Form(new FormProcedureInputUser());
        $users = User::get()->pluck('name', 'id');
        $form->select('user_id', __('User name'))->options($users)->load('pond_detail_id', '/admin/pond-details/by_user_id')->rules('required');
        $form->select('pond_detail_id', __('Kolam User'))->rules('required')->load('form_procedure_detail_id', '/admin/form-procedure-details/by_pond_detail_id');
        $form->date('reported_at', __('Reported at'))->default(date('Y-m-d'))->rules('required');

        $form->hasMany('form_procedure_detail_input', 'Formulir', function (Form\NestedForm $form) {
            $form->select('form_procedure_detail_id', __('Pertanyaan'))->rules('required');
            $form->select('form_procedure_detail_formula_id', __('Pilih Nilai'))->rules('required');
            // $form->decimal('score', __('Score'))->rules('required');
        });

        return $form;
    }
}
