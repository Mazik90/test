<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use System\View;

class BaseAuthController extends Controller
{
    protected $styles;
    protected $scripts;


    public function __construct()
    {
        $this->styles = [
            'assets/bootstrap/css/bootstrap.min.css',
            'assets/public/css/app.css'
        ];

        $this->scripts = [
            'assets/bootstrap/js/bootstrap.min.js',
            'assets/public/js/app.js'
        ];

        $this->view = View::factory('base', [
            'styles' => $this->styles,
            'scripts' => $this->scripts
        ]);
    }
}