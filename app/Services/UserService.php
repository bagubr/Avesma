<?php

namespace App\Services;

use App\Models\User;
use App\Utils\Response;

class UserService {
    use Response;
    
    public static function create(array|User $user) : User {
        return is_array($user) 
            ? User::create($user)
            : $user->save();
    }

    public static function authenticate(User $user) {
        if(empty($user)) (new self)->sendFailedResponse([], 'Mohon maaf akun anda tidak dapat kami temukan');
        $token = $user->createToken((new self)->generateToken($user));
        $user->refresh();
        return [$user, $token];
    }

    private static function generateToken(User $user) {
        return sha1(base64_encode($_SERVER['HTTP_USER_AGENT'].time().$user->email));
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
        