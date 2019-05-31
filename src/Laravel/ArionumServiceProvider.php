<?php

namespace pxgamer\Arionum\Laravel;

use pxgamer\Arionum\Arionum;
use Illuminate\Support\ServiceProvider;

final class ArionumServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/config/arionum.php' => $this->app->configPath('arionum.php'),
        ], 'config');
    }

    public function register(): void
    {
        $this->app->singleton('arionum', function () {
            return new Arionum($this->app->get('config')->get('arionum.node-uri'));
        });
    }
}
