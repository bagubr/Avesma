<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository {
    public static function findByPhone(string $phone) : User {
        return User::where('phone', 'ilike', "%$phone%")->first();
    }

    public static function findByEmail(string $email) : User {
        return User::where('email', 'ilike', "%$email%")->first();
    }
}
        