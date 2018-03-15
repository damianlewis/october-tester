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
    public function getListWidgetSelector($id = null)
    {
        return '.list-widget' . $id ? $id : '' . "[data-control='listwidget']";
    }

    /**
     * Get the css selector to select a list widget checkbox.
     *
     * @param null|string $id
     *
     * @return string
     */
    public function getListCheckboxSelector($id)
    {
        return ".list-checkbox label[for*='checkbox-${id}']";
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
     * Get the css selector to select the search component.
     *
     * @param $type
     *
     * @return string The css selector.
     */
    public function getSearchSelector($type)
    {
        return "input[name='" . $this->getSearchName($type) . "']";
    }

    /**
     * Get the field name for the search component.
     *
     * @param $type
     *
     * @return string.
     */
    public function getSearchName($type)
    {
        return "${type}Search[term]";
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
     * Get the css selector to select the navigation tabs.
     *
     * @param string $tab
     *
     * @return string
     */
    public function getNavigationTabSelector($tab)
    {
        return $this->getNavigationTabsSelector() . " a[title='${tab}']";
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
     * Get the css selector to select a tab pane.
     *
     * @param string $tabId
     *
     * @return string
     */
    public function getTabPaneSelector($tabId)
    {
        return ".tab-pane${tabId}";
    }

    /**
     * Get the css selector to select a form widget.
     *
     * @param null|string $id
     *
     * @return string
     */
    public function getFormWidgetSelector($id = null)
    {
        return '.form-widget' . $id ? $id : '' . "[data-control='formwidget']";
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
    public function getFormFieldWidgetSelector($type, $name)
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
     * Get the css selector to select a relation controller popup.
     *
     * @param $type
     *
     * @return string
     */
    public function getPopupSelector($type)
    {
        return "[id*='${type}Popup']";
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
     * Get the css selector to select the alert component.
     *
     * @return string
     */
    public function getAlertSelector()
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