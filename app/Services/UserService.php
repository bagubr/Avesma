<?php

namespace App\Services;

use App\Models\User;

class UserService {
    public static function create(array|User $user) : User {
        return is_array($user) 
            ? User::create($user)
            : $user->save();
    }

    public static function updateFcmToken(User|int $user, string|null $token) {
        if(is_int($user)) $user = User::find($user);
        if(empty($token)) return $user;
        $user->update([
            'fcm_token'=>$token
        ]);
        $user->refresh();
        return $user;
    }
}
        