<?php

namespace DamianLewis\OctoberTesting;

use BackendAuth;
use Exception;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

abstract class WebDriverTestCase extends \Illuminate\Foundation\Testing\TestCase
{
    use Concerns\ProvidesBrowser;

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

        Browser::$userCredentialsResolver = function () {
            return $this->getUserCredentials();
        };
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
        return config('webdriver.baseUrl');
    }

    /**
     * Get a callback that returns the default user credentials to authenticate.
     *
     * @return \Closure
     * @throws \Exception
     */
    protected function getUserCredentials()
    {
        throw new Exception("User credentials resolver has not been set.");
    }

}