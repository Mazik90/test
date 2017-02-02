<?php

namespace System\Facades;

class Auth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Auth';
    }
}