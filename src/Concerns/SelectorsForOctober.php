<?php

namespace DamianLewis\OctoberTesting\Concerns;

trait SelectorsForOctober
{
    /**
     * Get the css selector to select a list widget.
     *
     * @param null|string $id
     *
     * @return string
     */
    public function getListSelector($id = null)
    {
        return '.list-widget' . $id ? $id : '' . "[data-control='listwidget']";
    }

    /**
     * Get the css selector to select the list pagination component.
     *
     * @return string The css selector.
     */
    public function getListPaginationSelector()
    {
        return '.list-pagination';
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
    public function getTableHeaderSelector($column)
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
    public function getTableDataSelector($column)
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
     * @return string
     */
    public function getFilterSelector($name)
    {
        return "[data-control='filterwidget'] [data-scope-name='${name}']";
    }

    /**
     * Get the css selector to select the filter items.
     *
     * @return string
     */
    public function getFilterItemSelector()
    {
        return '.filter-items li';
    }

    /**
     * Get the css selector to select the primary tab.
     *
     * @return string
     */
    public function getPrimaryTabsSelector()
    {
        return '.primary-tabs';
    }

    /**
     * Get the css selector to select the navigation tabs.
     *
     * @return string
     */
    public function getNavigationTabsSelector()
    {
        return '.nav-tabs';
    }

    /**
     * Get the css selector to select the tab content.
     *
     * @return string
     */
    public function getTabContentSelector()
    {
        return '.tab-content';
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
     * Get the css selector to select a relation controller.
     *
     * @param $name
     *
     * @return string
     */
    public function getRelationControllerSelector($name)
    {
        return "[id*='RelationController'][data-request-data*='${name}']";
    }

    /**
     * Get the css selector to select the breadcrumb component.
     *
     * @return string
     */
    public function getBreadcrumbSelector()
    {
        return '.control-breadcrumb';
    }

    /**
     * Get the css selector to select the form preview component.
     *
     * @return string
     */
    public function getFormPreviewSelector()
    {
        return '.form-preview';
    }

    /**
     * Get the css selector to select the trash button.
     *
     * @return string
     */
    public function getTrashButtonSelector()
    {
        return '.form-buttons .oc-icon-trash-o';
    }

    /**
     * Get the css selector to select the flash message component.
     *
     * @return string
     */
    public function getFlashMessageSelector()
    {
        return 'p.flash-message';
    }

    /**
     * Get the css selector to select the popup modal component.
     *
     * @return string
     */
    public function getPopupModalSelector()
    {
        return '.sweet-alert';
    }

    /**
     * Get the css selector to select the stripe loading indicator component.
     *
     * @return string
     */
    public function getStripeLoadingIndicatorSelector()
    {
        return '.stripe-loading-indicator';
    }
}