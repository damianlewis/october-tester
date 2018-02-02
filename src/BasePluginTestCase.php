<?php

namespace DamianLewis\OctoberTesting;

use Mail;
use System\Classes\PluginManager;
use System\Classes\UpdateManager;

abstract class BasePluginTestCase extends \Illuminate\Foundation\Testing\TestCase
{
    use Concerns\OctoberTasks;

    /**
     * Cache for storing which plugins have been loaded and refreshed.
     *
     * @var array
     */
    protected $pluginTestCaseLoadedPlugins = [];

    /**
     * Perform test case set up.
     *
     * @return void
     * @throws \Exception
     * @throws \ReflectionException
     */
    public function setUp()
    {
        /*
         * Force reload of October singletons
         */
        PluginManager::forgetInstance();
        UpdateManager::forgetInstance();

        /*
         * Create application instance
         */
        parent::setUp();

        /*
         * Ensure system is up to date
         */
        $this->runOctoberUpCommand();

        /*
         * Detect plugin from test and autoload it
         */
        $this->pluginTestCaseLoadedPlugins = [];
        $pluginCode = $this->guessPluginCodeFromTest();

        if ($pluginCode !== false) {
            $this->runPluginRefreshCommand($pluginCode, false);
        }

        /*
         * Disable mailer
         */
        Mail::pretend();
    }

    /**
     * Flush event listeners and collect garbage.
     *
     * @return void
     * @throws \ReflectionException
     */
    public function tearDown()
    {
        $this->flushModelEventListeners();
        parent::tearDown();
        unset($this->app);
    }

}
