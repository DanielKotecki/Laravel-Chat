<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ReverbApi extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'reverb-api';
    }
}
