<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Kreait\Firebase\Messaging\CloudMessage;

class NotificationService {

    public static function sendTo($title, $body, User $user, $payload = [])
    {
        $messaging = app('firebase.messaging');
        $data = [
            'title' => $title,
            'body'  => $body,
            'user_id' => $user->id
        ];
        $message = CloudMessage::withTarget('token', $user->fcm_token)
        ->withNotification($data) // optional
            ->withData($payload) // optional
        ;
        $messaging->send($message);
        return Notification::create($data);
    }
    
    public static function sendSome($title, $body, Collection $user, $payload = [])
    {
        // $data = [
        //     'title' => $title,
        //     'body'  => $body,
        // ];
        // $users = $user->pluck('fcm_token')->toArray();
        // $messaging = app('firebase.messaging');
        // $message = CloudMessage::fromArray([
        //     'token' => array_unique($users),
        //     'notification' => 'Test',
        //     'data' => $payload
        // ]);
        // $messaging->send($message);
        // return $data;
    }

    public static function sendAll($title, $body, User $user, $payload = [])
    {
        // $messages = [

        // ];

        // $message = CloudMessage::new(); // Any instance of Kreait\Messaging\Message

        // /** @var Kreait\Firebase\Messaging\MulticastSendReport $sendReport **/
        // $sendReport = $messaging->sendAll($messages);
    }
}
        