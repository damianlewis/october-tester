<?php

namespace DamianLewis\OctoberTesting\Concerns;

use Closure;
use DamianLewis\OctoberTesting\Browser;

trait InteractsWithOctober
{
    /**
     * Execute a Closure within a breadcrumb component.
     *
     * @param Closure $callback
     *
     * @return $this
     */
    public function withinBreadcrumb(Closure $callback)
    {
        return $this->with('.control-breadcrumb', $callback);
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
        return $this->withinTab('.primary-tabs', $tab, $callback);
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
            $tabId = $tabs->attribute(".nav-tabs a[title='${tab}']", 'data-target');

            $tabs->click(".nav-tabs a[title='${tab}']")
                ->within(".tab-content ${tabId}", $callback);
        });
    }
}
