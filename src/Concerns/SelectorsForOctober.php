<?php

namespace DamianLewis\OctoberTesting\Concerns;

trait SelectorsForOctober
{

    /**
     * Get the css selector to select a list widget header.
     *
     * @return string
     */
    public function getListHeaderSelector()
    {
        return '#Lists table thead';
    }

    /**
     * Get the css selector to select a list widget header cell.
     *
     * @param int|string $column
     *
     * @return string
     */
    public function getListHeaderCellSelector($column)
    {
        return $this->getListHeaderSelector() . ' ' . $this->getTableHeaderSelector($column);
    }

    /**
     * Get the css selector to select a list widget body.
     *
     * @return string
     */
    public function getListBodySelector()
    {
        return '#Lists table tbody';
    }

    /**
     * Get the css selector to select the a list widget body column.
     *
     * @param int|string $column
     *
     * @return string
     */
    public function getListBodyColumnSelector($column)
    {
        return $this->getListBodySelector() . ' ' . $this->getTableDataSelector($column);
    }

    /**
     * Get the css selector to select a list widget body row.
     *
     * @param string $row
     *
     * @return string
     */
    public function getListBodyRowSelector($row = null)
    {
        return $this->getListBodySelector() . $row ? " tr${row}" : ' tr';
    }

    /**
     * Get the css selector to select the list pagination component.
     *
     * @return string The css selector.
     */
    public function getListPaginationSelector()
    {
        return '#Lists .list-pagination';
    }

    /**
     * Get the css selector to select the list search component.
     *
     * @return string The css selector.
     */
    public function getListSearchSelector()
    {
        return "input[name='" . $this->getListToolbarSearchName() . "']";
    }

    /**
     * Get the field name for the list toolbar search component.
     *
     * @return string.
     */
    public function getListToolbarSearchName()
    {
        return 'listToolbarSearch[term]';
    }

    /**
     * Get the css selector to select the table header for a table column.
     *
     * @param int|string $column
     *
     * @return string
     */
    public function getTableHeaderSelector($column = null)
    {
        if (is_int($column)) {
            return "th[class*='cell-index-${column}']";
        }

        if (is_string($column)) {
            return "th[class*='cell-name-${column}']";
        }
    }

    /**
     * Get the css selector to select the table data for a table column.
     *
     * @param int|string $column
     *
     * @return string
     */
    public function getTableDataSelector($column = null)
    {
        if (is_int($column)) {
            return "td[class*='cell-index-${column}']";
        }

        if (is_string($column)) {
            return "td[class*='cell-name-${column}']";
        }
    }

    /**
     * Get the css selector to select a filter.
     *
     * @param string $name
     *
     * @return string The css selector.
     */
    public function getFilterSelector($name)
    {
        return ".filter-scope[data-scope-name='${name}']";
    }

    /**
     * Get the css selector to select the filter items.
     *
     * @return string The css selector.
     */
    public function getFilterItemSelector()
    {
        return '.filter-items li';
    }

    /**
     * Get the css selector to select the filter links.
     *
     * @return string The css selector.
     */
    public function getFilterLinkSelector()
    {
        return $this->getFilterItemSelector() . ' a';
    }

    /**
     *  Get the css selector to select a form group.
     *
     * @param $name
     *
     * @return string
     */
    public function getFormGroupSelector($name)
    {
        return ".form-group[data-field-name='${name}']";
    }

    /**
     * Get the css selector to select a form field.
     *
     * @param $type
     * @param $name
     *
     * @return string
     */
    public function getFormFieldSelector($type, $name)
    {
        return ".${type}-field[data-field-name='${name}']";
    }

    /**
     * Get the css selector to select a form widget.
     *
     * @param $type
     * @param $name
     *
     * @return string
     */
    public function getFormWidgetSelector($type, $name)
    {
        return "[data-field-name='${name}'] [data-control='${type}']";
    }

    /**
     * Get the css selector to select the breadcrumb component.
     *
     * @return string
     */
    protected function getBreadcrumbSelector()
    {
        return '.control-breadcrumb';
    }

    /**
     * Get the css selector to select the form preview component.
     *
     * @return string
     */
    protected function getFormPreviewSelector()
    {
        return '.form-preview';
    }

    /**
     * Get the css selector to select the trash button.
     *
     * @return string
     */
    protected function getTrashButtonSelector()
    {
        return '.form-buttons .oc-icon-trash-o';
    }

    /**
     * Get the css selector to select the flash message component.
     *
     * @return string
     */
    protected function getFlashMessageSelector()
    {
        return 'p.flash-message';
    }

    /**
     * Get the css selector to select the popup modal component.
     *
     * @return string
     */
    protected function getPopupModalSelector()
    {
        return '.sweet-alert';
    }

    /**
     * Get the css selector to select the stripe loading indicator component.
     *
     * @return string
     */
    protected function getStripeLoadingIndicatorSelector()
    {
        return '.stripe-loading-indicator';
    }
}