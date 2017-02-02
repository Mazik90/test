<?php

namespace System\Helpers;

use System\Application;

class URL
{
    public static function getCurrentUrl()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public static function site($url)
    {
        return Application::$init['baseDir'] . $url;
    }

    public static function asset($url){
        return self::site($url.'?v='.filemtime(PUBLIC_PATH . '/' . $url));
    }
}