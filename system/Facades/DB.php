<?php

namespace System\Facades;

class DB extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Database';
    }
}