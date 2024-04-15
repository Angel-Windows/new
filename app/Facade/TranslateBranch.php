<?php

namespace App\Facade;

use Illuminate\Support\Facades\Facade;

class TranslateBranch extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'translate';
    }
}
