<?php

namespace App\Admin\Actions\UserInformation;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Confirmation extends RowAction
{
    public $name = 'Confirm';

    public function handle(Model $model)
    {
        $model->status = 'CONFIRMED';
        $model->save();
        return $this->response()->success('Success message.')->refresh();
    }

    public function dialog()
    {
        $this->confirm('Are you sure to confirmed this?');
    }

}