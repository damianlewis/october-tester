<?php

namespace DamianLewis\OctoberTester;

use Closure;
use Laravel\Dusk\Browser as BaseBrowser;

class Browser extends BaseBrowser
{
    use Concerns\InteractsWithAuthentication,
        Concerns\InteractsWithOctober,
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
     * Execute a Closure within a primary tab.
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
     * Execute a Closure within a content tab.
     *
     * @param string  $tab
     * @param Closure $callback
     *
     * @return $this
     */
    public function withinContentTab($tab, Closure $callback)
    {
        return $this->withinTab($this->getContentTabsSelector(), $tab, $callback);
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
}