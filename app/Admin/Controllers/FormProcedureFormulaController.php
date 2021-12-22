<?php

namespace App\Admin\Controllers;

use App\Models\FishSpecies;
use App\Models\FormProcedure;
use App\Models\FormProcedureFormula;
use App\Models\Procedure;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\MessageBag;

class FormProcedureFormulaController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Formula SOP';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new FormProcedureFormula());


        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->equal('form_procedure.procedure_id', 'SOP')->select(
                Procedure::all()->pluck('title', 'id')
            );
            $filter->equal('form_procedure.fish_species_id', 'Spesies Ikan')->select(
                FishSpecies::all()->pluck('name', 'id')
            );
        });
        $grid->column('fish_and_procedure', __('Procedure'));
        $grid->column('note', __('Note'));
        $grid->column('min_range', __('Min range'));
        $grid->column('max_range', __('Max range'));
        $grid->disableRowSelector();
        $grid->disableColumnSelector();
        $grid->disableExport();

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
        $show = new Show(FormProcedureFormula::findOrFail($id));

        $show->field('fish_and_procedure', __('Procedure'));
        $show->field('note', __('Note'));
        $show->field('min_range', __('Min range'));
        $show->field('max_range', __('Max range'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        $show->panel()->tools(function (Show\Tools $tool) {
            $tool->disableDelete();
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
        $form = new Form(new FormProcedureFormula());

        $form_procedure = FormProcedure::get()->pluck('fish_and_procedure', 'id');
        $form->select('form_procedure_id', 'Procedure')->options($form_procedure)->rules('required');
        $form->text('note', __('Note'))->rules('required');
        $form->decimal('min_range', __('Min range'));
        $form->decimal('max_range', __('Max range'))->rules('required|gt:min_range');

        $form->disableEditingCheck();
        $form->disableViewCheck();
        $form->disableCreatingCheck();

        return $form;

        // return $form->saving(function (Form $form) {
        // $max_range = FormProcedureFormula::whereFormProcedureId($form->form_procedure_id)->orderBy('id', 'desc')->first()?->max_range??0;
        // if($max_range >= $form->min_range){
        //     $error = new MessageBag([
        //         'title'   => 'min_range invalid',
        //         'message' => 'min_range must be greather before last formula',
        //     ]);
        //     return back()->with(compact('error'));
        // }
        // $score = FormProcedureFormula::whereFormProcedureId($form->form_procedure_id)->orderBy('id', 'desc')->first()?->score??0;
        // if($score >= $form->score){
        //     $error = new MessageBag([
        //         'title'   => 'score invalid',
        //         'message' => 'score must be greather before last formula',
        //     ]);
        //     return back()->with(compact('error'));
        // }
        //  });
    }
}
