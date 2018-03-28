<?php

namespace DamianLewis\OctoberTester;

use Exception;
use Illuminate\Support\ServiceProvider;

class OctoberTesterServiceProvider extends ServiceProvider
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
            throw new Exception('It is unsafe to run OctoberTester in production.');
        }

        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\InstallCommand::class
            ]);
        }
    }
}
