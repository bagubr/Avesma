<?php

namespace App\Admin\Actions\UserInformation;

use App\Models\User;
use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Kreait\Firebase\Messaging\Message;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Kreait\Firebase\Messaging\CloudMessage;

class Confirmation extends RowAction
{
    public $name = 'Confirm';

    public function handle(Model $model)
    {
        $model->status = 'CONFIRMED';
        $model->save();
        $messaging = app('firebase.messaging');
        $deviceToken = User::find($model->user_id)->fcm_token;

        $message = CloudMessage::withTarget('token', $deviceToken)
            // ->withNotification($notification) // optional
            // ->withData($data) // optional
        ;

        // $message = CloudMessage::fromArray([
        //     'token' => $deviceToken,
        //     // 'notification' => [/* Notification data as array */], // optional
        //     // 'data' => [/* data array */], // optional
        // ]);

        $messaging->send($message);
        return $this->response()->success('Success message.')->refresh();
    }

    public function dialog()
    {
        $this->confirm('Are you sure to confirmed this?');
    }

}