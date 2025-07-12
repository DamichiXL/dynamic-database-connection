<?php

namespace DamichiXL\Settings\Providers;

use DamichiXL\Settings\Facades\SettingsFacade;
use DamichiXL\Settings\helpers\SettingsHelper;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/settings.php', 'settings');

        $this->app->bind('setting', function () {
            return new SettingsHelper;
        });
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/settings.php' => config_path('settings.php'),
        ]);

        $this->loadMigrationsFrom(__DIR__.'/../migrations');

        if (Schema::connection(config('settings.database.connection'))->hasTable('settings')) {
            $dotFlattenedSettings = Arr::dot(SettingsFacade::get());

            config($dotFlattenedSettings);
        }
    }
}
