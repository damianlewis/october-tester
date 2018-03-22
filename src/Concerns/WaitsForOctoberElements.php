<?php

namespace DamianLewis\OctoberTesting\Concerns;

use Closure;

trait WaitsForOctoberElements
{
    /**
     * Execute the given callback in a scoped browser once the popup is available.
     *
     * @param  string  $type
     * @param  Closure $callback
     * @param  int     $seconds
     *
     * @return $this
     */
    public function whenPopupAvailable($type, Closure $callback, $seconds = null)
    {
        return $this->waitFor($this->getPopupSelector($type), $seconds)->with($type, $callback);
    }
}
