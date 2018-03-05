<?php

namespace DamianLewis\OctoberTesting;

use Exception;
use Illuminate\Support\ServiceProvider;

class OctoberTestingServiceProvider extends ServiceProvider
{
    /**
     * Register any package services.
     *
     * @return void
     * @throws Exception
     */
    public function register()
    {
        if ($this->app->environment('production')) {
            throw new Exception('It is unsafe to run October Tesing in production.');
        }

        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\InstallCommand::class
            ]);
        }
    }
}
