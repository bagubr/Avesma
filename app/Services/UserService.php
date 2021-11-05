<?php

namespace App\Services;

use App\Models\User;

class UserService {
    public static function create(array|User $user) : User {
        return is_array($user) 
            ? User::create($user)
            : $user->save();
    }
}
        