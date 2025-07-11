<?php

namespace DamichiXL\Settings\helpers;

use DamichiXL\Settings\Models\Settings;
use Illuminate\Support\Facades\Cache;

class SettingsHelper
{
    public function get(?string $key = null, $default = null): mixed
    {
        $settings = Cache::rememberForever(
            'settings',
            fn () => Settings::all()->pluck('value', 'key')->toArray()
        );

        if ($key) {
            return $settings[$key] ?? $default;
        }

        return $settings ?? $default;
    }
}
