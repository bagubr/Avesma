<?php

namespace App\Admin\Controllers;

use App\Models\Outcome;
use App\Models\OutcomeCategory;
use App\Models\OutcomeDetail;
use App\Models\OutcomeSetting;
use App\Models\PondDetail;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OutcomeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Outcome';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Outcome());

        
        $grid->column('pond_detail.pond_spesies', __('Kolam Ikan'));
        $grid->column('total_nominal', __('Total nominal'));
        $grid->column('outcome_category_name', __('Kategory Pengeluaran'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Outcome::findOrFail($id));
        $show->field('pond_detail.pond_spesies', __('Kolam Ikan'));
        $show->field('total_nominal', __('Total nominal'));
        $show->field('outcome_category_name', __('Kategory Pengeluaran'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Outcome());

        $form->column(1/2, function ($form) {
            $form->select('pond_detail_id', __('Kolam Ikan'))->options(PondDetail::get()->pluck('text', 'id'))->required();
            $form->date('reported_at', __('Reported At'))->required()->default(date('Y-m-d H:i:s'));
            $form->select('outcome_category_id', 'Kategori Pengeluaran')->options(OutcomeCategory::get()->pluck('name', 'id'))->required()->load('outcome_setting_id','/admin/outcome-settings/get_by_outcome_category_id');
            // $form->currency('total_nominal', __('Total nominal'))->required();
        });
        $form->column(1/2, function ($form) {
            $form->hasMany('outcome_detail', 'Pengeluaran', function (Form\NestedForm $form) {
                $form->select('outcome_setting_id', __('Pengeluaran List'));
                $form->currency('nominal', __('Nominal'));
            });
            
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
