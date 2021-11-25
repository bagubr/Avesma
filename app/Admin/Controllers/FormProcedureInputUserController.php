<?php

namespace App\Admin\Controllers;

use App\Models\FormProcedure;
use App\Models\FormProcedureDetailFormula;
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
    protected $title = 'Formulir Data';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FormProcedureInputUser());
        $grid->disableFilter();
        $grid->quickSearch('user.name', 'fish_and_procedure', 'pond_detail.pond_spesies', 'reported_at');
        $grid->column('user.name', __('User Name'));
        $grid->column('pond_detail.pond_spesies', __('Kolam'));
        $grid->column('form_procedure.fish_and_procedure', __('SOP'));
        $grid->column('total_score', __('Score'));
        $grid->column('form_procedure_formula', __('Hasil'));
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
        $show->field('user.name', __('User Name'));
        $show->field('pond_detail.pond_spesies', __('Kolam'));
        $show->field('form_procedure_formula', __('Hasil'));
        $show->field('total_score', __('Score'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('reported_at', __('Reported at'));

        $show->form_procedure_detail_input('Isian', function ($procedure) {

            $procedure->setResource('/admin/form-procedure-detail-inputs');
            $procedure->form_procedure_detail()->name('Pertanyaan');
            $procedure->form_procedure_detail_formula()->parameter('Pilihan');
            $procedure->score();
            $procedure->disableCreateButton();
            $procedure->disableFilter();
            $procedure->disableExport();
            $procedure->disableColumnSelector();
            $procedure->disablePagination();
            $procedure->disableRowSelector();
            $procedure->disableActions();
        });

        $show->panel()->tools(function (Show\Tools $tool)
        {
            $tool->disableDelete();
            $tool->disableList();
            $tool->disableEdit();
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
        $form->select('form_procedure_id', __('SOP'))->options(FormProcedure::get()->pluck('fish_and_procedure', 'id'))->rules('required')->load('form_procedure_detail_id', '/admin/form-procedure-details/by_pond_detail_id');
        $users = User::get()->pluck('name', 'id');
        $form->select('user_id', __('User name'))->options($users)->load('pond_detail_id', '/admin/pond-details/by_user_id')->rules('required');
        $form->select('pond_detail_id', __('Kolam User'))->options(PondDetail::get()->pluck('text', 'id'))->rules('required');
        $form->date('reported_at', __('Reported at'))->default(date('Y-m-d'))->rules('required');

        $form->hasMany('form_procedure_detail_input', 'Isian', function (Form\NestedForm $form) {
            $form->select('form_procedure_detail_id', __('Pertanyaan'))->rules('required')->options(FormProcedureDetailFormula::get()->pluck('text', 'id'))->load('form_procedure_detail_formula_id', '/admin/form-procedure-detail-formula/get_by_form_procedure_detail')->rules('required');
            $form->select('form_procedure_detail_formula_id', __('Pilih Nilai'))->options(FormProcedureDetailFormula::get()->pluck('text', 'id'))->rules('required');
        });

        return $form;
    }
}
