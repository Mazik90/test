<?php

namespace System\Facades;

use System;

abstract class Facade
{
    protected static $resolvedInstance = [];

    /**
     * @return string
     * @throws \Exception
     */
    protected static function getFacadeAccessor()
    {
        throw new \Exception('Facade does not implement getFacadeAccessor method.');
    }

    public static function getFacadeRoot()
    {
        return static::resolveFacadeInstance(static::getFacadeAccessor());
    }

    protected static function resolveFacadeInstance($name)
    {
        if (is_object($name)) {
            return $name;
        }

        if (isset(static::$resolvedInstance[$name])) {
            return static::$resolvedInstance[$name];
        }

        $className = '\System\\' . $name;

        return static::$resolvedInstance[$name] = new $className();
    }

    public static function __callStatic($method, $args)
    {
        $instance = static::getFacadeRoot();

        if (!$instance) {
            throw new \Exception('A facade root has not been set.');
        }

        return $instance->$method(...$args);
    }
}