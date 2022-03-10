<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\Models\Cycle;
use App\Models\User;

class CycleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Cycle';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Cycle());

        $grid->column('user.name', __('User Name'));
        $grid->column('name', __('Name'));
        $grid->column('start_at', __('Start at'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('status', __('Status'));

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
        $show = new Show(Cycle::findOrFail($id));

        $show->field('user.name', __('User Name'));
        $show->field('name', __('Name'));
        $show->field('start_at', __('Start at'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('status', __('Status'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Cycle());

        $form->select('user_id', __('User Name'))->options(User::get()->pluck('name', 'id'));
        $form->text('name', __('Name'));
        $form->date('start_at', __('Start at'));
        $form->select('status', __('Status'))->options([
            'ONGOING' => 'Sedang Berlangsung',
            'FINISH' => 'Selesai'
        ]);

        return $form;
    }
}
