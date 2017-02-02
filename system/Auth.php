<?php

namespace System;

use System\Facades\DB;

class Auth
{
    public static $config;

    private static $user;

    public function __construct()
    {
        self::$config = include CONFIG_PATH . '/auth.php';
    }

    public function login($username, $password)
    {
        $queryString = 'select users.id from users '
            . 'left join users_roles on users.id = users_roles.user_id '
            . 'where users.name = :username and users.password = :password and users_roles.role_id = :role_id limit 1';

        $user = DB::select($queryString, [
            'username' => $username,
            'password' => $this->hash($password),
            'role_id'  => 1,
        ]);

        if (!empty($user)) {
            $_SESSION['user_id'] = $user[0]->id;
            return true;
        } else {
            return false;
        }
    }

    public function getUser()
    {
        if (!$this->check()) {
            return false;
        }

        if (self::$user === null) {
            self::$user = DB::select('select * from users where id = :id', [
                'id' => $_SESSION['user_id'],
            ])[0];
        }

        return self::$user;
    }

    public function check()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        }

        return false;
    }

    public function hash($password)
    {
        return sha1(self::$config['auth_key'] . $password);
    }

    public function logout()
    {
        session_destroy();
    }
}