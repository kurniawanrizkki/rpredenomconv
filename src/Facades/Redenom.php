<?php

namespace Rpredenomconv\Facades;

use Illuminate\Support\Facades\Facade;

class Redenom extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'rpredenomconv';
    }
}

