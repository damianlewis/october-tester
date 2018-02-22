<?php

namespace DamianLewis\OctoberTesting\Concerns;

use Closure;
use DamianLewis\OctoberTesting\Browser;

trait InteractsWithOctober
{
    /**
     * Execute a Closure within a list widget header.
     *
     * @param Closure $callback
     *
     * @return $this
     */
    public function withinListHeader(Closure $callback)
    {
        $selector = $this->getListHeaderSelector() . ' th';

        return $this->with($selector, $callback);
    }

    /**
     * Execute a Closure within a list widget header cell.
     *
     * @param string  $column
     * @param Closure $callback
     *
     * @return $this
     */
    public function withinListHeaderCell($column, Closure $callback)
    {
        $selector = $this->getListHeaderSelector() . ' ' . $this->getTableHeaderSelector($column);

        return $this->with($selector, $callback);
    }

    /**
     * Execute a Closure within a list widget body.
     *
     * @param Closure $callback
     *
     * @return $this
     */
    public function withinListBody(Closure $callback)
    {
        $selector = $this->getListBodySelector() . ' td';

        return $this->with($selector, $callback);
    }

    /**
     * Execute a Closure within a list widget body column.
     *
     * @param string  $column
     * @param Closure $callback
     *
     * @return $this
     */
    public function withinListBodyColumn($column, Closure $callback)
    {
        $selector = $this->getListBodySelector() . ' ' . $this->getTableDataSelector($column);

        return $this->with($selector, $callback);
    }

    /**
     * Execute a Closure within a list widget body row.
     *
     * @param string  $row
     * @param Closure $callback
     *
     * @return $this
     */
    public function withinListBodyRow($row, Closure $callback)
    {
        $selector = $this->getListBodySelector() . " tr.${row}" . ' td';

        return $this->with($selector, $callback);
    }

    /**
     * Execute a Closure within a list widget body cell.
     *
     * @param string  $column
     * @param string  $row
     * @param Closure $callback
     *
     * @return $this
     */
    public function withinListBodyCell($row, $column, Closure $callback)
    {
        $selector = $this->getListBodySelector() . " tr.${row}" . ' ' . $this->getTableDataSelector($column);

        return $this->with($selector, $callback);
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

    /**
     * Get the css selector to select the table head from a list widget.
     *
     * @return string
     */
    private function getListHeaderSelector()
    {
        return '#Lists table thead';
    }

    /**
     * Get the css selector to select the table body from a list widget.
     *
     * @return string
     */
    private function getListBodySelector()
    {
        return '#Lists table tbody';
    }

    /**
     * Get the css selector to select the table data for a table column.
     *
     * @param int|string $column
     *
     * @return string
     */
    private function getTableDataSelector($column)
    {
        if (is_int($column)) {
            return "td[class*='cell-index-${column}']";
        }

        if (is_string($column)) {
            return "td[class*='cell-name-${column}']";
        }
    }

    /**
     * Get the css selector to select the table header for a table column.
     *
     * @param int|string $column
     *
     * @return string
     */
    private function getTableHeaderSelector($column = null)
    {
        if (is_int($column)) {
            return "th[class*='cell-index-${column}']";
        }

        if (is_string($column)) {
            return "th[class*='cell-name-${column}']";
        }
    }
}
