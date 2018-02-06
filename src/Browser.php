<?php

namespace DamianLewis\OctoberTesting;

use Closure;
use Illuminate\Support\Str;
use Facebook\WebDriver\WebDriverDimension;

class Browser
{
    use Concerns\InteractsWithAuthentication;
    use Concerns\InteractsWithElements;
    use Concerns\MakesAssertions;

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
     * Get the callback which resolves the default user to authenticate.
     *
     * @var \Closure
     */
    public static $userCredentialsResolver;

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
     * @param  ElementResolver                            $resolver
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
     * @return $this
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
     * Refresh the page.
     *
     * @return $this
     */
    public function refresh()
    {
        $this->driver->navigate()->refresh();

        return $this;
    }

    /**
     * Navigate to the previous page.
     *
     * @return $this
     */
    public function back()
    {
        $this->driver->navigate()->back();

        return $this;
    }

    /**
     * Maximize the browser window.
     *
     * @return $this
     */
    public function maximize()
    {
        $this->driver->manage()->window()->maximize();

        return $this;
    }

    /**
     * Resize the browser window.
     *
     * @param  int $width
     * @param  int $height
     *
     * @return $this
     */
    public function resize($width, $height)
    {
        $this->driver->manage()->window()->setSize(
            new WebDriverDimension($width, $height)
        );

        return $this;
    }

    /**
     * Take a screenshot and store it with the given name.
     *
     * @param  string $name
     *
     * @return $this
     */
    public function screenshot($name)
    {
        $this->driver->takeScreenshot(
            sprintf('%s/%s.png', rtrim(static::$storeScreenshotsAt, '/'), $name)
        );

        return $this;
    }

    /**
     * Execute a Closure with a scoped browser instance.
     *
     * @param  string   $selector
     * @param  \Closure $callback
     *
     * @return $this
     */
    public function within($selector, Closure $callback)
    {
        return $this->with($selector, $callback);
    }

    /**
     * Execute a Closure with a scoped browser instance.
     *
     * @param  string   $selector
     * @param  \Closure $callback
     *
     * @return $this
     */
    public function with($selector, Closure $callback)
    {
        $browser = new static(
            $this->driver, new ElementResolver($this->driver, $this->resolver->format($selector))
        );

        call_user_func($callback, $browser);

        return $this;
    }

    /**
     * Ensure that jQuery is available on the page.
     *
     * @return void
     */
    public function ensurejQueryIsAvailable()
    {
        if ($this->driver->executeScript("return window.jQuery == null")) {
            $this->driver->executeScript(file_get_contents(__DIR__ . '/../bin/jquery.js'));
        }
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