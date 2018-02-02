<?php

namespace DamianLewis\OctoberTesting;

use Illuminate\Support\Str;

class Browser
{
    use Traits\InteractsWithElements;
    use Traits\MakesAssertions;

    /**
     * The base URL for all URLs.
     *
     * @var string
     */
    public static $baseUrl;

    /**
     * The directory that will contain any screenshots.
     *
     * @var string
     */
    public static $storeScreenshotsAt;

    /**
     * The RemoteWebDriver instance.
     *
     * @var \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    public $driver;

    /**
     * The element resolver instance.
     *
     * @var ElementResolver
     */
    public $resolver;

    /**
     * Create a browser instance.
     *
     * @param  \Facebook\WebDriver\Remote\RemoteWebDriver $driver
     * @param  ElementResolver  $resolver
     *
     * @return void
     */
    public function __construct($driver, $resolver = null)
    {
        $this->driver = $driver;

        $this->resolver = $resolver ?: new ElementResolver($driver);

    }

    /**
     * Browse to the given URL.
     *
     * @param  string $url
     *
     * @return \DamianLewis\OctoberTesting\Browser
     */
    public function visit($url)
    {
        if (!Str::startsWith($url, ['http://', 'https://'])) {
            $url = static::$baseUrl . '/' . ltrim($url, '/');
        }

        $this->driver->navigate()->to($url);

        return $this;
    }

    /**
     * Take a screenshot and store it with the given name.
     *
     * @param  string $name
     *
     * @return \DamianLewis\OctoberTesting\Browser
     */
    public function screenshot($name)
    {
        $this->driver->takeScreenshot(
            sprintf('%s/%s.png', rtrim(static::$storeScreenshotsAt, '/'), $name)
        );

        return $this;
    }

    /**
     * Close the browser.
     *
     * @return void
     */
    public function quit()
    {
        $this->driver->quit();
    }

}