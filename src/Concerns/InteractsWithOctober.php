<?php

namespace DamianLewis\OctoberTesting\Concerns;

trait InteractsWithOctober
{
    /**
     * Click the given list row.
     *
     * @param string $row
     *
     * @return $this
     */
    public function clickListRow($row)
    {
        $this->resolver->findOrFail("table tbody tr:nth-child(${row})")->click();

        return $this;
    }

    /**
     * Click the checkbox at the given list row.
     *
     * @param string $row
     *
     * @return $this
     */
    public function clickListCheckbox($row)
    {
        $this->resolver->findOrFail("table tbody tr:nth-child(${row}) " . $this->getListCheckboxLabelSelector())->click();

        return $this;
    }

    /**
     * Directly get the value attribute of a checkbox input field at the given list row.
     *
     * @param string $row
     *
     * @return string
     */
    public function valueOfListCheckbox($row)
    {
        return $this->resolver->findOrFail("table tbody tr:nth-child(${row}) " . $this->getListCheckboxSelector())->getAttribute('value');
    }
}
