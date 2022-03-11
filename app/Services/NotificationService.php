<?php

namespace App\Services;

use App\Models\FormProcedure;
use App\Models\FormProcedureDetailInput;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Kreait\Firebase\Messaging\CloudMessage;

class NotificationService {

    public static function sendTo($title, $body, User $user, $payload = null)
    {
        $messaging = app('firebase.messaging');
        ($payload)?$type = get_class($payload):$type = null;
        $data = [
            'title' => $title,
            'body'  => $body,
            'type'  =>  str_replace('App\\Models\\', '', $type),
            'payload'  => $payload,
            'reference_id'  => $payload->id,
            'channelId' => 'com.cancreative.avesma',
            'user_id' => $user->id
        ];
        if($user->fcm_token){
            $message = CloudMessage::withTarget('token', $user->fcm_token)
            ->withNotification($data)
                ->withData($data)
            ;
            $messaging->send($message);
        }
        return Notification::create($data);
    }
    
    public static function sendSome($title, $body, Collection $user, $payload = null)
    {
        $messaging = app('firebase.messaging');
        $data = [];
        foreach ($user as $value) {
            $data[] = [
                'title'     => $title,
                'body'      => $body,
                'user_id'   => $value->id,
                'type'      => str_replace('App\\Models\\', '', get_class($payload)),
                'payload'   => $payload,
                'reference_id'=> $payload->id,
                'channelId' => 'com.cancreative.avesma',
                'created_at'=> now()->toDateTimeString(),
                'updated_at'=> now()->toDateTimeString(),
            ];
            $message = CloudMessage::withTarget('token', $value->fcm_token)
                ->withNotification($data)
                    ->withData($data)
                ;
            $messaging->send($message);
        }
        $chunks = array_chunk($data, 5000);
        foreach ($chunks as $value) {
            Notification::insert($value);
        }

    }

    public static function sendToTopic($title, $body, $topic, $payload = null)
    {
        $messaging = app('firebase.messaging');
        $user = User::whereNotNull('fcm_token')->get()->pluck('id');
        $data = [];
        foreach ($user as $value) {
            $data[] = [
                'title'     => $title,
                'body'      => $body,
                'user_id'   => $value,
                'type'      => str_replace('App\\Models\\', '', get_class($payload)),
                'payload'   => $payload,
                'reference_id'=> $payload->id,
                'channelId' => 'com.cancreative.avesma',
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
            ->withData($data[0]) // optional
        ;
        $messaging->send($message);
    }
}
        