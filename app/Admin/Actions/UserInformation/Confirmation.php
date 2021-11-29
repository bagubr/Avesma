<?php

namespace App\Admin\Actions\UserInformation;

use App\Services\NotificationService;
use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class Confirmation extends RowAction
{
    public $name = 'Confirm';

    public function handle(Model $model)
    {
        $model->status = 'CONFIRMED';
        $model->save();
        NotificationService::sendTo('Konfirmasi Admin', 'Data anda telah di verifikasi', $model->user);
        return $this->response()->success('Success message.')->refresh();
    }

    public function dialog()
    {
        $this->confirm('Are you sure to confirmed this?');
    }

}