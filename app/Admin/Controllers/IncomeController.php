<?php

namespace App\Admin\Controllers;

use App\Models\Income;
use App\Models\PondDetail;
use App\Models\PondDetailProduct;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class IncomeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Data Pemasukan';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Income());
        $grid->filter(function($filter){
            $filter->disableIdFilter();
            $filter->ilike('pond_detail.pond.name', 'Kolam');
            $filter->ilike('pond_detail.fish_species.name', 'Spesies Ikan');
        
        });        
        $grid->column('pond_spesies', __('Kolam Ikan'));
        $grid->column('reported_at', __('Reported at'));
        $grid->column('total_price', __('Total Pendapatan'));
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
        $show = new Show(Income::findOrFail($id));

        $show->field('pond_spesies', __('Kolam Ikan'));
        $show->field('reported_at', __('Reported at'));
        $show->field('total_price', __('Total Pendapatan'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        $show->income_detail('Pendapatan', function (Grid $income_detail) {
            $income_detail->setResource('/admin/income_details');
            $income_detail->product_name();
            $income_detail->weight();
            $income_detail->price();
            $income_detail->total_price();
            $income_detail->disableCreateButton();
            $income_detail->disableFilter();
            $income_detail->disableExport();
            $income_detail->disableColumnSelector();
            $income_detail->disablePagination();
            $income_detail->disableRowSelector();
            $income_detail->disableActions();
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
        $form = new Form(new Income());

        $form->select('pond_detail_id', __('Kolam Ikan'))->options(PondDetail::get()->pluck('pond_spesies', 'id'))->load('pond_detail_product_id', '/admin/pond-detail-product/get_by_pond_detail')->rules('required');
        $form->datetime('reported_at', __('Reported at'))->default(date('Y-m-d H:i:s'))->rules('required');
        
        $form->hasMany('income_detail', 'Pendapatan', function (Form\NestedForm $form) {
            $form->select('pond_detail_product_id', __('Name'))->options(PondDetailProduct::get()->pluck('name', 'id'));
            $form->decimal('weight', __('Weight'));
            $form->currency('price', __('Price'));
            $form->currency('total_price', __('Total price'));
        });

        return $form;
    }
}
