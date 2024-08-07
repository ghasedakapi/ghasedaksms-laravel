<?php

namespace Ghasedaksms\GhasedaksmsLaravel;

use Ghasedak\GhasedaksmsApi;
use Ghasedaksms\GhasedaksmsLaravel\Channel\GhasedaksmsChannel;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;

class GhasedaksmsLaravelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('ghasedaksms.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'ghasedaksms');

        $this->app->singleton('ghasedaksms', function ($app) {
            return new GhasedaksmsApi(
                $app['config']->get('ghasedaksms.api_key')
            );
        });
        Notification::resolved(function ($service) {
            $service->extend('ghasedaksms', function ($app) {
                return new GhasedaksmsChannel($app->make('ghasedaksms'));
            });
        });
    }
}
