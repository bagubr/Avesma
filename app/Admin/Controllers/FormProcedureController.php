<?php

namespace App\Admin\Controllers;

use App\Models\FishSpecies;
use App\Models\FormProcedure;
use App\Models\Procedure;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FormProcedureController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'FormProcedure';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */

     
    protected function grid()
    {
        $grid = new Grid(new FormProcedure());
        $grid->column('procedure.title', __('Procedure'));
        $grid->column('fish_species.name', __('Fish Species'));
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
        $show = new Show(FormProcedure::findOrFail($id));
        $show->field('procedure.title', __('Procedure'));
        $show->field('fish_species.name', __('Fish Species'));
        $show->procedure('Procedure', function ($procedure) {

            $procedure->setResource('/admin/procedures');

            $procedure->title();
            $procedure->image()->image();
        });

        $show->fish_species('Spesies', function ($procedure) {

            $procedure->setResource('/admin/fish-species');

            $procedure->name();
            $procedure->image()->image();
        });

        $show->form_procedure_formula('Formula', function ($procedure_formula) {

            $procedure_formula->setResource('/admin/form-procedure-formulas');
            $procedure_formula->note();
            $procedure_formula->min_range();
            $procedure_formula->max_range();
            $procedure_formula->score();
        });

        $show->form_procedure_detail('Formulir', function ($procedure_formula) {

            $procedure_formula->setResource('/admin/form-procedure-details');
            $procedure_formula->name();
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

        
        $form->hasMany('form_procedure_detail', 'Formulir', function (Form\NestedForm $form) {
            $form->text('name', __('Name'));
        });

        $form->hasMany('form_procedure_formula', 'Penilaian', function (Form\NestedForm $form) {
            $form->number('min_range', __('Min range'));
            $form->number('max_range', __('Max range'));
            $form->text('note', __('Note'));
        });
        return $form;
    }
}
