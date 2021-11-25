<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\FormProcedureDetailFormula\Create;
use App\Admin\Actions\FormProcedureDetailFormula\ListParameter;
use App\Models\FishSpecies;
use App\Models\FormProcedure;
use App\Models\Procedure;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Tab;

class FormProcedureController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Formulir SOP';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */

     
    protected function grid()
    {
        $grid = new Grid(new FormProcedure());
        $grid->quickSearch('procedure.title', 'fish_species.name');
        $grid->column('procedure.title', __('Procedure'));
        $grid->column('fish_species.name', __('Fish Species'));
        $grid->column('created_at', __('Created at'));
        $grid->disableRowSelector();
        $grid->disableColumnSelector();
        $grid->disableExport();
        $grid->disableFilter();
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
        $show = new Show(FormProcedure::findOrFail($id));
        $show->field('procedure.title', __('Procedure'));
        $show->field('fish_species.name', __('Fish Species'));
        $show->procedure('Procedure', function ($procedure) {

            $procedure->setResource('/admin/procedures');

            $procedure->title();
            $procedure->image()->image();

            $procedure->panel()->tools(function ($tools)
            {
                $tools->disableList();
                $tools->disableEdit();
                $tools->disableDelete();
            });
        });

        $show->fish_species('Spesies', function ($fish_species) {

            $fish_species->setResource('/admin/fish-species');

            $fish_species->name();
            $fish_species->image()->image();

            $fish_species->panel()->tools(function ($tools)
            {
                $tools->disableList();
                $tools->disableEdit();
                $tools->disableDelete();
            });
        });

        $show->form_procedure_detail('Formulir SOP', function (Grid $form_procedure_detail) {

            $form_procedure_detail->setResource('/admin/form-procedure-details');
            $form_procedure_detail->name();
            $form_procedure_detail->disableCreateButton();
            $form_procedure_detail->disableFilter();
            $form_procedure_detail->disableExport();
            $form_procedure_detail->disableColumnSelector();
            $form_procedure_detail->disablePagination();
            $form_procedure_detail->disableRowSelector();
            $form_procedure_detail->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableDelete();
                $actions->disableView();
                $actions->add(new Create());
                $actions->add(new ListParameter());
            });
            
        });
        
        $show->form_procedure_formula('Formula SOP', function (Grid $procedure_formula) {

            $procedure_formula->resource('/admin/form-procedure-formulas');
            $procedure_formula->note();
            $procedure_formula->min_range();
            $procedure_formula->max_range();
            $procedure_formula->disableCreateButton();
            $procedure_formula->disableFilter();
            $procedure_formula->disableExport();
            $procedure_formula->disableColumnSelector();
            $procedure_formula->disableActions();
            $procedure_formula->disablePagination();
            $procedure_formula->disableRowSelector();
        });

        $show->panel()->tools(function ($tools)
        {
            $tools->disableList();
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
        $form = new Form(new FormProcedure());
        $procedure = Procedure::get()->pluck('title', 'id');
        $form->select('procedure_id', 'Procedure')->options($procedure)->rules('required|unique_with:form_procedures,fish_species_id,{{id}}');
        $spesies = FishSpecies::get()->pluck('name', 'id');
        $form->select('fish_species_id', 'Spesies')->options($spesies)->rules('required');

        
        $form->hasMany('form_procedure_detail', 'Formulir SOP', function (Form\NestedForm $form) {
            $form->text('name', __('Name'));
        });

        $form->hasMany('form_procedure_formula', 'Formula SOP', function (Form\NestedForm $form) {
            $form->number('min_range', __('Min range'));
            $form->number('max_range', __('Max range'));
            $form->text('note', __('Note'));
        });
        $form->disableCreatingCheck();
        $form->disableEditingCheck();
        $form->disableViewCheck();
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
        });
        return $form;
    }
}
