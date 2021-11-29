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
        if($user->fcm_token){
            $message = CloudMessage::withTarget('token', $user->fcm_token)
            ->withNotification($data)
                ->withData($payload)
            ;
            $messaging->send($message);
        }
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

    public static function sendToTopic($title, $body, $topic, $payload = [])
    {
        $messaging = app('firebase.messaging');
        $user = User::whereNotNull('fcm_token')->get()->pluck('id');
        $data = [];
        foreach ($user as $value) {
            $data[] = [
                'title'     => $title,
                'body'      => $body,
                'user_id'   => $value,
                'created_at'=> now()->toDateTimeString(),
                'updated_at'=> now()->toDateTimeString(),
            ];
        }
        $chunks = array_chunk($data, 5000);
        foreach ($chunks as $value) {
            Notification::insert($value);
        }

        $message = CloudMessage::withTarget('topic', $topic)
            ->withNotification([
                'title' => $title,
                'body'  => $body
            ]) // optional
            ->withData($payload) // optional
        ;
        $messaging->send($message);
    }
}
        