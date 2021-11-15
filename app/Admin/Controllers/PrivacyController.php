<?php

namespace App\Admin\Controllers;

use App\Models\PrivacyPolicy;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PrivacyController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Kebijakan Privasi';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PrivacyPolicy());
        if (PrivacyPolicy::all()->count() == 1) {
            $grid->disableCreateButton();
        }
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
            $actions->disableDelete();
        });

        $grid->column('description', __('Deskripsi'));

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
        $show = new Show(PrivacyPolicy::findOrFail($id));

        $show->field('description', __('Deskripsi'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new PrivacyPolicy());

        $form->summernote('description', __('Deskripsi'));

        return $form;
    }
}
