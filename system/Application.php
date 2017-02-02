<?php

namespace System;

class Application
{
    public static $init;

    private $routes = [];

    public function start()
    {
        $uri = strstr($_SERVER['REQUEST_URI'], '?', true);

        if ($uri === false) {
            $uri = $_SERVER['REQUEST_URI'];
        }

        foreach ($this->routes as $key => $route) {
            if ($uri == $key) {
                $nameRoute = explode('@', $route);
                $controllerName = '\\' . $nameRoute[0];
                $controller = new $controllerName();

                $result = $controller->$nameRoute[1]();

                if (@get_class($result) == 'System\View') {
                    echo $result->render();
                    return;
                } else {
                    exit($result);
                }
            }
        }

        //Переделать на Exception 404
        throw new \Exception('Страници не существует!');
    }

    public function addRoute($uri, $action)
    {
        $uri = substr($uri, 0, 1) != '/' ? '/' . $uri : $uri;
        $this->routes[$uri] = $action;
    }

    public function init(array $data)
    {
        self::$init = $data;
    }
}