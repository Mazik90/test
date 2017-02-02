<?php

namespace App\Controllers\Pub\Ajax;

use System\Facades\Auth;
use System\Helpers\URL;

class BaseAjaxController
{
    protected $user;

    public function __construct()
    {
        if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            throw new \Exception('no ajax');
        }

        if (!Auth::check()) {
            header('Location: ' . URL::site('auth'));
        }

        $this->user = Auth::getUser();
    }
}