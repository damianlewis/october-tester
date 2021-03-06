<?php

namespace DamianLewis\OctoberTester\Concerns;

use PHPUnit\Framework\Assert as PHPUnit;

trait MakesOctoberAssertions
{
    /**
     * Assert that the given text appears within the given form group.
     *
     * @param string $name
     * @param string $text
     *
     * @return $this
     */
    public function assertSeeInFormGroup($name, $text)
    {
        return $this->assertSeeIn(
            $this->getFormGroupSelector($name),
            $text
        );
    }

    /**
     * Assert that the form group with the given name is visible.
     *
     * @param string $name
     *
     * @return $this
     */
    public function assertFormGroupVisible($name)
    {
        return $this->assertVisible(
            $this->getFormGroupSelector($name)
        );
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
        return $this->assertMissing(
            $this->getFormGroupSelector($name)
        );
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
        return $this->assertVisible(
            $this->getFormFieldSelector($type, $name)
        );
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
        return $this->assertMissing(
            $this->getFormFieldSelector($type, $name)
        );
    }

    /**
     * Assert that the form field  widget with the given type and name is visible.
     *
     * @param string $type
     * @param string $name
     *
     * @return $this
     */
    public function assertFormFieldWidgetVisible($type, $name)
    {
        return $this->assertVisible(
            $this->getFormFieldWidgetSelector($type, $name)
        );
    }

    /**
     * Assert that the form field widget with the given type and name is not on the page.
     *
     * @param string $type
     * @param string $name
     *
     * @return $this
     */
    public function assertFormFieldWidgetMissing($type, $name)
    {
        return $this->assertMissing(
            $this->getFormFieldWidgetSelector($type, $name)
        );
    }

    /**
     * Assert that the 'readonly' attribute appears within the given selector.
     *
     * @param string $selector
     *
     * @return $this
     */
    public function assertReadOnly($selector)
    {
        $fullSelector = $this->resolver->format($selector);

        $element = $this->resolver->findOrFail($selector);

        PHPUnit::assertTrue(
            !is_null($element->getAttribute('readonly')),
            "Did not see 'readonly' attribute within element [{$fullSelector}]."
        );

        return $this;
    }
}
