<?php

namespace App\Admin\Controllers;

use App\Models\Testimonial;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TestimonialController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Testimonial';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Testimonial());

        $grid->column('name', __('Name'));
        $grid->column('position', __('Position'));
        $grid->column('message', __('Message'));
        $grid->column('image', __('Image'))->image();

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
        $show = new Show(Testimonial::findOrFail($id));

        $show->field('name', __('Name'));
        $show->field('position', __('Position'));
        $show->field('message', __('Message'));
        $show->field('image', __('Image'))->image();

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Testimonial());

        $form->text('name', __('Name'));
        $form->text('position', __('Position'));
        $form->textarea('message', __('Message'));
        $form->image('image', __('Image'));

        return $form;
    }
}
