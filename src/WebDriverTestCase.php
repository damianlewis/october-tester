<?php

namespace DamianLewis\OctoberTesting;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

abstract class WebDriverTestCase extends Illuminate\Foundation\Testing\TestCase
{
    use Traits\ProvidesBrowser;

    /**
     * Register the base URL and create a browser instance.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        Browser::$baseUrl = $this->baseUrl();
        Browser::$storeScreenshotsAt = base_path('tests/screenshots');
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {
        return RemoteWebDriver::create(
            'http://localhost:9515', DesiredCapabilities::chrome()
        );
    }

    /**
     * Determine the application's base URL.
     *
     * @return string
     */
    protected function baseUrl()
    {
        return config('selenium.baseUrl');
    }

}