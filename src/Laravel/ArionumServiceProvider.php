<?php

namespace pxgamer\Arionum\Laravel;

use pxgamer\Arionum\Arionum;
use Illuminate\Support\ServiceProvider;
use pxgamer\Arionum\Exceptions\InvalidNodeUriException;

final class ArionumServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/config/arionum.php' => $this->app->configPath('arionum.php'),
        ], 'config');

        $this->mergeConfigFrom(__DIR__.'/config/arionum.php', 'arionum');
    }

    public function register(): void
    {
        $this->app->singleton(Arionum::class, function () {
            if (! $this->app->get('config')->get('arionum.node-uri')) {
                throw InvalidNodeUriException::laravelEnvNotSet();
            }

            return new Arionum($this->app->get('config')->get('arionum.node-uri'));
        });

        $this->app->alias(Arionum::class, 'arionum');
    }
}
