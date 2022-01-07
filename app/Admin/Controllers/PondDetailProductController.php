<?php

namespace App\Admin\Controllers;

use App\Models\PondDetailProduct;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class PondDetailProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'PondDetailProduct';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PondDetailProduct());

        $grid->column('id', __('Id'));
        $grid->column('pond_detail_id', __('Pond detail id'));
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
        $show = new Show(PondDetailProduct::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('pond_detail_id', __('Pond detail id'));
        $show->field('name', __('Name'));
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
        $form = new Form(new PondDetailProduct());

        $form->number('pond_detail_id', __('Pond detail id'));
        $form->text('name', __('Name'));

        return $form;
    }

    public function getByPondDetail(Request $request)
    {
        $pond_detail_id = $request->get('q');
        return PondDetailProduct::wherePondDetailId($pond_detail_id)->get();
    }
}
