<?php

namespace DamichiXL\Settings\Facades;

use Illuminate\Support\Facades\Facade;

class SettingsFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'setting';
    }
}
