<?php

namespace App\Admin\Controllers;

use App\Models\OutcomeCategory;
use App\Models\OutcomeSetting;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class OutcomeSettingController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Jenis Pengeluaran';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new OutcomeSetting());

        $grid->disableFilter();
        $grid->disableExport();
        $grid->disableRowSelector();
        $grid->disableColumnSelector();
        $grid->quickSearch('name', 'outcome_category.name');
        $grid->column('outcome_category.name', __('Kategori Pengeluaran'));
        $grid->column('name', __('Name'));
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
        $show = new Show(OutcomeSetting::findOrFail($id));

        $show->field('outcome_category.name', __('Kategori Pengeluran'));
        $show->field('name', __('Name'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
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
        $form = new Form(new OutcomeSetting());

        $form->select('outcome_category_id', __('Kategori Pengeluaran'))->options(OutcomeCategory::get()->pluck('name', 'id'));
        $form->text('name', __('Name'));

        $form->disableEditingCheck();

        return $form;
    }

    public function getByOutcomeCategoryId(Request $request)
    {
        $category_id =  $request->get('q');
        $outcome_setting = OutcomeSetting::where('outcome_category_id', $category_id)->get();
        return $outcome_setting;
    }
}
