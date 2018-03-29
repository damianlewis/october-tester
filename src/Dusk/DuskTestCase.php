<?php
//The MIT License (MIT)
//
//Copyright (c) Taylor Otwell
//
//Permission is hereby granted, free of charge, to any person obtaining a copy
//of this software and associated documentation files (the "Software"), to deal
//in the Software without restriction, including without limitation the rights
//to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
//copies of the Software, and to permit persons to whom the Software is
//furnished to do so, subject to the following conditions:
//
//The above copyright notice and this permission notice shall be included in
//all copies or substantial portions of the Software.
//
//THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
//IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
//FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
//AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
//LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
//OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
//THE SOFTWARE.

namespace DamianLewis\OctoberTester\Dusk;

use BackendAuth;
use DamianLewis\OctoberTester\Browser;
use DamianLewis\OctoberTester\Concerns;
use DamianLewis\OctoberTester\October\OctoberTestCase;
use Exception;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Symfony\Component\Finder\Finder;

abstract class DuskTestCase extends OctoberTestCase
{
    use Concerns\ProvidesBrowser;

    /**
     * Register the base URL and create a browser instance.
     *
     * @return void
     * @throws \Exception
     * @throws \ReflectionException
     */
    public function setUp()
    {
        parent::setUp();

        Browser::$baseUrl = $this->baseUrl();

        Browser::$storeScreenshotsAt = base_path('tests/Browser/screenshots');

        Browser::$storeConsoleLogAt = base_path('tests/Browser/console');

        Browser::$userCredentialsResolver = function () {
            return $this->getUserCredentials();
        };

        $this->purgeScreenshots();
        $this->purgeLogs();
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {
        $options = (new ChromeOptions())->addArguments(config('webdriver.chromeOptions'));

        return RemoteWebDriver::create(
            config('webdriver.host'),
            DesiredCapabilities::chrome()->setCapability(ChromeOptions::CAPABILITY, $options)
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
     * @return void
     * @throws \Exception
     */
    protected function getUserCredentials()
    {
        throw new Exception("User credentials resolver has not been set.");
    }

    /**
     * Purge the failure screenshots
     *
     * @return void
     */
    protected function purgeScreenshots()
    {
        $files = Finder::create()->files()
            ->in(Browser::$storeScreenshotsAt)
            ->name('failure-*');

        foreach ($files as $file) {
            @unlink($file->getRealPath());
        }
    }

    /**
     * Purge the failure logs
     *
     * @return void
     */
    protected function purgeLogs()
    {
        $files = Finder::create()->files()
            ->in(Browser::$storeConsoleLogAt)
            ->name('*.log');

        foreach ($files as $file) {
            @unlink($file->getRealPath());
        }
    }
}