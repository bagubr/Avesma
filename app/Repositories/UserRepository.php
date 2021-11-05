<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository {
    public static function findByPhone(string $phone) : User|null {
        return User::where('phone', 'like', "$phone")->first();
    }

    public static function findByEmail(string $email) : User|null {
        return User::where('email', 'like', "%$email%")->first();
    }
}
        