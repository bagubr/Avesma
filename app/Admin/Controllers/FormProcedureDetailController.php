<?php

namespace App\Admin\Controllers;

use App\Models\FormProcedure;
use App\Models\FormProcedureDetail;
use App\Models\PondDetail;
use App\Models\Procedure;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Tools\QuickSearch;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class FormProcedureDetailController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Formulir Isian';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FormProcedureDetail());
        $grid->disableRowSelector();
        $grid->disableFilter();
        $grid->disableExport();
        $grid->disableColumnSelector();
        $grid->QuickSearch('fish_and_procedure', 'name');
        $grid->column('fish_and_procedure', __('Formulir SOP'));
        $grid->column('name', __('Name'));

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
        $show = new Show(FormProcedureDetail::findOrFail($id));
        $show->field('name', __('Name'));
        $show->field('fish_and_procedure', __('Form Procedure'));
        $show->field('created_at', __('Created at'));

        
        $show->form_procedure_detail_formulas('Pilihan', function ($procedure) {

            $procedure->setResource('/admin/form-procedure-detail-formulas');
            $procedure->parameter();
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
        $form = new Form(new FormProcedureDetail());
        $form_procedure = FormProcedure::get()->pluck('fish_and_procedure', 'id');
        $form->select('form_procedure_id', __('Form Procedure'))->options($form_procedure)->readonly();
        $form->text('name', __('Name'));

        $form->hasMany('form_procedure_detail_formulas', 'Penilaian', function (Form\NestedForm $form) {
            $form->text('parameter', __('Parameter'));
            $form->number('score', __('Score'));
        });

        $form->disableCreatingCheck();
        $form->disableEditingCheck();
        $form->disableViewCheck();
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableList();
            $tools->disableView();
            $tools->add('<a href="'.url()->previous().'" class="btn btn-sm btn-info">Back</a>');
        });

        return $form;
    }

    public function byPondDetailId(Request $request)
    {
        $id = $request->get('q');

        $form = FormProcedureDetail::where('form_procedure_id', $id)->get(['id', 'name', 'form_procedure_id']);

        return $form;


    }
}
