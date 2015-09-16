<?php namespace Wibleh\Crummy\Support\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class Crummy extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'crummy';
    }
}
