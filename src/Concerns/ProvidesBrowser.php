<?php

namespace DamianLewis\OctoberTester\Concerns;

use DamianLewis\OctoberTester\Browser;

trait ProvidesBrowser
{
    use Laravel\Dusk\Concerns\ProvidesBrowser;

    /**
     * Create a new Browser instance.
     *
     * @param  \Facebook\WebDriver\Remote\RemoteWebDriver  $driver
     * @return \Laravel\Dusk\Browser
     */
    protected function newBrowser($driver)
    {
        return new Browser($driver);
    }
}