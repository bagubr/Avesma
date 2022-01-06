<?php

namespace App\Admin\Controllers;

use App\Models\CustomerService;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CustomerServiceController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Customer Service';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CustomerService());
        $grid->disableFilter();
        $grid->quickSearch('name', 'email', 'phone', 'message');
        $grid->disableExport();
        $grid->disableActions();
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('phone', __('Phone'));
        $grid->column('message', __('Message'));
        $grid->column('created_at', __('Created at'));
        $grid->disableCreateButton();

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
        $show = new Show(CustomerService::findOrFail($id));

        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('phone', __('Phone'));
        $show->field('message', __('Message'));
        $show->field('created_at', __('Created at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new CustomerService());

        $form->text('name', __('Name'));
        $form->email('email', __('Email'));
        $form->mobile('phone', __('Phone'));
        $form->textarea('message', __('Message'));

        return $form;
    }
}
