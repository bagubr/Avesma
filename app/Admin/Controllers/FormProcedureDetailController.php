<?php

namespace App\Admin\Controllers;

use App\Models\FormProcedure;
use App\Models\FormProcedureDetail;
use App\Models\PondDetail;
use App\Models\Procedure;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class FormProcedureDetailController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'FormProcedureDetail';

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
        $grid->disableColumnSelector();
        $grid->column('fish_and_procedure', __('Form Procedure'));
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
        $form->select('form_procedure_id', __('Form Procedure'))->options($form_procedure);
        $form->text('name', __('Name'));

        return $form;
    }

    public function getDataByPondDetailId(Request $request)
    {
        $pond_details = PondDetail::find($request->get('q'));

        $form = FormProcedureDetail::whereHas('form_procedure', function ($query) use ($pond_details)
        {
            $query->where('fish_species_id', $pond_details->fish_species_id);
        })->get('id', 'name as text');

        return $form;


    }
}
