<?php

namespace DamianLewis\OctoberTesting\Concerns;

use PHPUnit\Framework\Assert as PHPUnit;
use Facebook\WebDriver\Exception\NoSuchElementException;

trait MakesOctoberAssertions
{
    /**
     * Assert that the form field with the given type and name is visible.
     *
     * @param string $type
     * @param string $name
     *
     * @return $this
     */
    public function assertFormFieldVisible($type, $name)
    {
        $selector = ".${type}-field[data-field-name='${name}']";
        $fullSelector = $this->resolver->format($selector);

        PHPUnit::assertTrue(
            $this->resolver->findOrFail($selector)->isDisplayed(),
            "Form field [{$fullSelector}] is not visible."
        );

        return $this;
    }

    /**
     * Assert that the form field with the given type and name is not on the page.
     *
     * @param string $type
     * @param string $name
     *
     * @return $this
     */
    public function assertFormFieldMissing($type, $name)
    {
        $selector = ".${type}-field[data-field-name='${name}']";
        $fullSelector = $this->resolver->format($selector);

        try {
            $missing = !$this->resolver->findOrFail($selector)->isDisplayed();
        } catch (NoSuchElementException $e) {
            $missing = true;
        }

        PHPUnit::assertTrue($missing, "Saw unexpected form field [{$fullSelector}].");

        return $this;
    }
}
