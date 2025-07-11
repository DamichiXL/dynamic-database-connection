<?php

namespace DamichiXL\Settings\Providers;

use DamichiXL\Settings\Models\Settings;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../migrations');

        if (Schema::connection('sqlite')->hasTable('settings')) {
            $settings = Cache::rememberForever(
                'settings',
                fn () => Settings::all()->pluck('value', 'key')->toArray()
            );

            config($settings);
        }
    }
}
