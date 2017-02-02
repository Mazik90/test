<?php

namespace App\Controllers\Auth;

use App\Models\User;
use System\Facades\Auth;
use System\Helpers\URL;
use System\View;

class AuthController extends BaseAuthController
{
    public function __construct()
    {
        parent::__construct();

        if (Auth::check()) {
            header('Location: /');
        }
    }

    public function index()
    {
        $content = View::factory('auth/v_auth');

        if (!empty($_POST)) {
            if (Auth::login($_POST['username'], $_POST['password'])) {
                header('Location: /');
            } else {
                $content->set([
                    'error' => 'Invalid login/password'
                ]);
            }
        }

        return $this->view->set([
            'title'   => 'Auth',
            'content' => $content,
        ]);
    }

    public function logout()
    {
        Auth::logout();
        header('Location: ' . URL::site('auth'));
    }

    public function register()
    {
        $content = View::factory('auth/v_register');

        if (!empty($_POST)) {
            if ($_POST['password'] == $_POST['confirm_password']) {
                (new User())->register($_POST);
                Auth::login($_POST['username'], $_POST['password']);
                header('Location: /');
            } else {
                $content->set([
                    'error' => 'Passwords must match',
                ]);
            }
        }

        return $this->view->set([
            'title'   => 'Register',
            'content' => $content,
        ]);
    }
}