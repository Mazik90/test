<?php

namespace App\Models;

use System\Facades\Auth;
use System\Facades\DB;

class User
{
    const LOGIN = 1;

    public function register(array $request)
    {
        $userId = DB::lastInsertId('insert into users (`name`, password, created_at) values (:username, :password, :created_at)', [
            'username'   => $request['username'],
            'password'   => Auth::hash($request['password']),
            'created_at' => time(),
        ]);

        DB::insert('insert into users_roles (user_id, role_id) values (:user_id, :role_id)', [
            'user_id' => $userId,
            'role_id' => self::LOGIN,
        ]);
    }
}