<?php

define('APP_PATH', __DIR__);
define('VIEWS_PATH', __DIR__ . '/../views');
define('CONFIG_PATH', __DIR__ . '/../config');
define('PUBLIC_PATH', __DIR__ . '/../public');

$application = new System\Application();

$application->init([
    'baseDir' => '/',
]);

//Routes
$application->addRoute('auth', 'App\Controllers\Auth\AuthController@index');
$application->addRoute('auth/register', 'App\Controllers\Auth\AuthController@register');
$application->addRoute('auth/logout', 'App\Controllers\Auth\AuthController@logout');

$application->addRoute('ajax/todo/delete', 'App\Controllers\Pub\Ajax\TodoController@delete');
$application->addRoute('ajax/todo/update', 'App\Controllers\Pub\Ajax\TodoController@update');

$application->addRoute('edit', 'App\Controllers\Pub\TodoController@edit');
$application->addRoute('create', 'App\Controllers\Pub\TodoController@create');
$application->addRoute('/', 'App\Controllers\Pub\TodoController@index');

return $application;