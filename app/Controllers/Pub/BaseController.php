<?php

namespace App\Controllers\Pub;

use App\Controllers\Controller;
use System\Facades\Auth;
use System\Helpers\URL;
use System\View;

class BaseController extends Controller
{
    protected $user;

    protected $styles;
    protected $scripts;

    public function __construct()
    {
        if (!Auth::check()) {
            header('Location: ' . URL::site('auth'));
        }

        $this->user = Auth::getUser();

        $this->styles = [
            'assets/bootstrap/css/bootstrap.min.css',
            'assets/public/css/app.css'
        ];

        $this->scripts = [
            'assets/bootstrap/js/bootstrap.min.js',
            'assets/public/js/app.js'
        ];

        $this->view = View::factory('base', [
            'styles'  => $this->styles,
            'scripts' => $this->scripts,
        ]);
    }
}