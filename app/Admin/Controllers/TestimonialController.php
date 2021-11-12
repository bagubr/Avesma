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

        $grid->column('name', __('Nama'));
        $grid->column('position', __('Jabatan'));
        $grid->column('message', __('Pesan'));
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

        $show->field('name', __('Nama'));
        $show->field('position', __('Jabatan'));
        $show->field('message', __('Pesan'));
        $show->field('image', __('Foto'))->image();

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

        $form->text('name', __('Nama'));
        $form->text('position', __('Jabatan'));
        $form->textarea('message', __('Pesan'));
        $form->image('image', __('Foto'));

        return $form;
    }
}
