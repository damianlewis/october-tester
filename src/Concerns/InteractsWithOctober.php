<?php

namespace DamianLewis\OctoberTesting\Concerns;

use Closure;

trait InteractsWithOctober
{
    /**
     * Execute a Closure within a breadcrumb component.
     *
     * @param  \Closure $callback
     *
     * @return $this
     */
    public function withinBreadcrumb(Closure $callback)
    {
        return $this->with('.control-breadcrumb', $callback);
    }
}
