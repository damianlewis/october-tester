<?php

namespace DamianLewis\OctoberTester;

use Closure;

class Browser extends \Laravel\Dusk\Browser
{
    use Concerns\InteractsWithOctober,
        Concerns\MakesOctoberAssertions,
        Concerns\SelectorsForOctober,
        Concerns\WaitsForOctoberElements;

    /**
     * Get the callback which resolves the default user to authenticate.
     *
     * @var \Closure
     */
    public static $userCredentialsResolver;

    /**
     * Create a browser instance.
     *
     * @param  \Facebook\WebDriver\Remote\RemoteWebDriver $driver
     * @param  ElementResolver                            $resolver
     *
     * @return void
     */
//    public function __construct($driver, $resolver = null)
//    {
//        $this->driver = $driver;
//
//        $this->resolver = $resolver ?: new ElementResolver($driver);
//
//    }

    /**
     * Browse to the given URL.
     *
     * @param  string $url
     *
     * @return $this
     */
//    public function visit($url)
//    {
//        if (!Str::startsWith($url, ['http://', 'https://'])) {
//            $url = static::$baseUrl . '/' . ltrim($url, '/');
//        }
//
//        $this->driver->navigate()->to($url);
//
//        return $this;
//    }

    /**
     * Execute a Closure within a list widget.
     *
     * @param string  $list
     * @param Closure $callback
     *
     * @return $this
     */
    public function withinListWidget($list, Closure $callback)
    {
        return $this->with($this->getListWidgetSelector($list), $callback);
    }

    /**
     * Execute a Closure within a form widget.
     *
     * @param string  $form
     * @param Closure $callback
     *
     * @return $this
     */
    public function withinFormWidget($form, Closure $callback)
    {
        return $this->with($this->getFormWidgetSelector($form), $callback);
    }

    /**
     * Execute a Closure within a primary form tab.
     *
     * @param string  $tab
     * @param Closure $callback
     *
     * @return $this
     */
    public function withinPrimaryTab($tab, Closure $callback)
    {
        return $this->withinTab($this->getPrimaryTabsSelector(), $tab, $callback);
    }

    /**
     * Execute a Closure within a form tab.
     *
     * @param string  $type
     * @param string  $tab
     * @param Closure $callback
     *
     * @return $this
     */
    public function withinTab($type, $tab, Closure $callback)
    {
        return $this->with($type, function (Browser $tabs) use ($tab, $callback) {
            $tabId = $tabs->attribute($this->getNavigationTabSelector($tab), 'data-target');

            $tabs->click($this->getNavigationTabSelector($tab))
                ->with($this->getTabContentSelector() . ' ' . $this->getTabPaneSelector($tabId), $callback);
        });
    }

    /**
     * Execute a Closure within a relation controller.
     *
     * @param string  $name
     * @param Closure $callback
     *
     * @return $this
     */
    public function withinRelationController($name, Closure $callback)
    {
        return $this->with($this->getRelationControllerSelector($name), $callback);
    }

    /**
     * Execute a Closure within a popup.
     *
     * @param string  $name
     * @param Closure $callback
     *
     * @return $this
     */
    public function withinPopup($name, Closure $callback)
    {
        return $this->with($this->getPopupSelector($name), $callback);
    }

    /**
     * Execute a Closure with a scoped browser instance.
     *
     * @param  string   $selector
     * @param  \Closure $callback
     *
     * @return $this
     */
//    public function with($selector, Closure $callback)
//    {
//        $browser = new static(
//            $this->driver, new ElementResolver($this->driver, $this->resolver->format($selector))
//        );
//
//        call_user_func($callback, $browser);
//
//        return $this;
//    }
}