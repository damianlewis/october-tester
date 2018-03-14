<?php

namespace DamianLewis\OctoberTesting\Concerns;

use Closure;
use DamianLewis\OctoberTesting\Browser;

trait InteractsWithOctober
{
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
        return $this->within($this->getListWidgetSelector($list), $callback);
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
        return $this->within($this->getFormWidgetSelector($form), $callback);
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
            $tabId = $tabs->attribute($this->getNavigationTabsSelector() . " a[title='${tab}']", 'data-target');

            $tabs->click($this->getNavigationTabsSelector() . " a[title='${tab}']")
                ->within($this->getTabContentSelector() . " ${tabId}", $callback);
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
        return $this->within($this->getRelationControllerSelector($name), $callback);
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
        return $this->within($this->getPopupSelector($name), $callback);
    }
}
