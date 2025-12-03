<?php

namespace Rpredenomconv;

use Illuminate\Support\ServiceProvider;
use Rpredenomconv\Services\RedenominationConverter;

class RpredenomconvServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/rpredenomconv.php',
            'rpredenomconv'
        );

        $this->app->singleton('rpredenomconv', function ($app) {
            return new RedenominationConverter(
                config('rpredenomconv')
            );
        });
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/rpredenomconv.php' => config_path('rpredenomconv.php'),
        ], 'rpredenomconv-config');
    }
}

