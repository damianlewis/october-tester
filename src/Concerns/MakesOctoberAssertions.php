<?php

namespace DamianLewis\OctoberTesting\Concerns;

use PHPUnit\Framework\Assert as PHPUnit;
use Facebook\WebDriver\Exception\NoSuchElementException;

trait MakesOctoberAssertions
{
    /**
     * Assert that the form group with the given name is visible.
     *
     * @param string $name
     *
     * @return $this
     */
    public function assertFormGroupVisible($name)
    {
        return $this->assertFormElementVisible(".form-group[data-field-name='${name}']", 'Form field');
    }

    /**
     * Assert that the form group with the given name is not on the page.
     *
     * @param string $name
     *
     * @return $this
     */
    public function assertFormGroupMissing($name)
    {
        return $this->assertFormElementMissing(".form-group[data-field-name='${name}']", 'form field');
    }
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
        return $this->assertFormElementVisible(".${type}-field[data-field-name='${name}']", 'Form field');
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
        return $this->assertFormElementMissing(".${type}-field[data-field-name='${name}']", 'form field');
    }

    /**
     * Assert that the form widget with the given type and name is visible.
     *
     * @param string $type
     * @param string $name
     *
     * @return $this
     */
    public function assertFormWidgetVisible($type, $name)
    {
        return $this->assertFormElementVisible("[data-field-name='${name}'] [data-control='${type}']", 'Form widget');
    }

    /**
     * Assert that the form widget with the given type and name is not on the page.
     *
     * @param string $type
     * @param string $name
     *
     * @return $this
     */
    public function assertFormWidgetMissing($type, $name)
    {
        return $this->assertFormElementMissing("[data-field-name='${name}'] [data-control='${type}']", 'form widget');
    }

    /**
     * Assert that the form element with the given selector is visible.
     *
     * @param string $selector
     * @param string $messageFragment
     *
     * @return $this
     */
    public function assertFormElementVisible($selector, $messageFragment)
    {
        $fullSelector = $this->resolver->format($selector);

        PHPUnit::assertTrue(
            $this->resolver->findOrFail($selector)->isDisplayed(),
            "${messageFragment} [{$fullSelector}] is not visible."
        );

        return $this;
    }

    /**
     * Assert that the element with the given selector is not on the page.
     *
     * @param string $selector
     * @param string $messageFragment
     *
     * @return $this
     */
    public function assertFormElementMissing($selector, $messageFragment)
    {
        $fullSelector = $this->resolver->format($selector);

        try {
            $missing = !$this->resolver->findOrFail($selector)->isDisplayed();
        } catch (NoSuchElementException $e) {
            $missing = true;
        }

        PHPUnit::assertTrue($missing, "Saw unexpected ${messageFragment} [{$fullSelector}].");

        return $this;
    }
}
