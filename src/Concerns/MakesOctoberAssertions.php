<?php

namespace DamianLewis\OctoberTesting\Concerns;

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
     * Assert that the form widget with the given type and name is visible.
     *
     * @param string $type
     * @param string $name
     *
     * @return $this
     */
    public function assertFormWidgetVisible($type, $name)
    {
        return $this->assertVisible(
            $this->getFormWidgetSelector($type, $name)
        );
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
        return $this->assertMissing(
            $this->getFormWidgetSelector($type, $name)
        );
    }
}
