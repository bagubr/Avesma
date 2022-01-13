<?php

namespace App\Admin\Actions\UserInformation;

use App\Models\UserInformation;
use App\Services\NotificationService;
use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class Decline extends RowAction
{
    public $name = 'Decline';

    public function handle(Model $model)
    {
        $model->status = 'DECLINE';
        $model->save();
        NotificationService::sendTo('Konfirmasi Admin', 'Data anda telah di tolak', $model->user, $model->user);
        return $this->response()->success('Success message.')->refresh();
    }

    public function dialog()
    {
        $this->confirm('Are you sure to decline this ?');
    }

}