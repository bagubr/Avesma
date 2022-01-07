<?php

namespace App\Admin\Controllers;

use App\Models\Version;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class VersionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Version';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Version());
        $grid->disableFilter();
        $grid->disableExport();
        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableView();
        });
        $grid->column('version', __('Version'));
        $grid->column('message', __('Message'));
        $grid->column('is_urgent', __('Is urgent'))->bool();
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
        $show = new Show(Version::findOrFail($id));



        $show->field('id', __('Id'));
        $show->field('version', __('Version'));
        $show->field('message', __('Message'));
        $show->field('is_urgent', __('Is urgent'));
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
        $form = new Form(new Version());

        $form->tools(function (Form\Tools $tools) {

            // Disable `List` btn.
            $tools->disableList();

            // Disable `Delete` btn.
            $tools->disableDelete();

            // Disable `Veiw` btn.
            $tools->disableView();
        });

        $form->text('version', __('Version'))->required();
        $form->textarea('message', __('Message'))->required();
        $form->switch('is_urgent', __('Is urgent'))->required();

        return $form;
    }
}
