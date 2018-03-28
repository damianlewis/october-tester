<?php

namespace DamianLewis\OctoberTester;

use DamianLewis\OctoberTester\Database\RefreshOctoberDatabase;
use Illuminate\Foundation\Testing\TestCase as FoundationTestCase;
use Mail;
use System\Classes\PluginManager;
use System\Classes\UpdateManager;

abstract class BasePluginTestCase extends FoundationTestCase
{
    use Tasks\OctoberTasks,
        Tasks\EnvTasks;

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
         * Switch to the testing environment
         */
        if (file_exists(base_path($this->envTestingFile()))) {
            if (file_get_contents(base_path('.env')) !== file_get_contents(base_path($this->envTestingFile()))) {
                $this->switchEnvironment();
            }

            $this->refreshEnvironment();
        }

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
     * Boot the testing helper traits.
     *
     * @return array
     */
    protected function setUpTraits()
    {
        $uses = parent::setUpTraits();

        if (isset($uses[RefreshOctoberDatabase::class])) {
            $this->refreshDatabase();
        }

        return $uses;
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

        /*
         * Restore environment
         */
        if (file_exists(base_path($this->envTestingFile())) && file_exists(base_path('.env.backup'))) {
            $this->restoreEnvironment();
        }
    }

}
