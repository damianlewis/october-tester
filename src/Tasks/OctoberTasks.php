<?php

namespace DamianLewis\OctoberTesting\Tasks;

use Artisan;
use Exception;
use ReflectionClass;
use System\Classes\PluginManager;
use October\Rain\Database\Model as ActiveRecord;

trait OctoberTasks
{
    /**
     * Migrate database using october:up command.
     *
     * @return void
     */
    protected function runOctoberUpCommand()
    {
        Artisan::call('october:up');
    }

    /**
     * Since the test environment has loaded all the test plugins
     * natively, this method will ensure the desired plugin is
     * loaded in the system before proceeding to migrate it.
     *
     * @return void
     * @throws \Exception
     */
    protected function runPluginRefreshCommand($code, $throwException = true)
    {
        if (!preg_match('/^[\w+]*\.[\w+]*$/', $code)) {
            if (!$throwException) {
                return;
            }
            throw new Exception(sprintf('Invalid plugin code: "%s"', $code));
        }

        $manager = PluginManager::instance();
        $plugin = $manager->findByIdentifier($code);

        /*
         * First time seeing this plugin, load it up
         */
        if (!$plugin) {
            $namespace = '\\' . str_replace('.', '\\', strtolower($code));
            $path = array_get($manager->getPluginNamespaces(), $namespace);

            if (!$path) {
                if (!$throwException) {
                    return;
                }
                throw new Exception(sprintf('Unable to find plugin with code: "%s"', $code));
            }

            $plugin = $manager->loadPlugin($namespace, $path) ?? null;
        }

        /*
         * Spin over dependencies and refresh them too
         */
        $this->pluginTestCaseLoadedPlugins[$code] = $plugin;

        if (!empty($plugin->require)) {
            foreach ((array)$plugin->require as $dependency) {

                if (isset($this->pluginTestCaseLoadedPlugins[$dependency])) {
                    continue;
                }

                $this->runPluginRefreshCommand($dependency);
            }
        }

        /*
         * Execute the command
         */
        Artisan::call('plugin:refresh', ['name' => $code]);
    }

    /**
     * Returns a plugin object from its code, useful for registering events, etc.
     *
     * @param string $code
     *
     * @return \System\Classes\PluginBase
     * @throws \ReflectionException
     */
    protected function getPluginObject($code = null)
    {
        if ($code === null) {
            $code = $this->guessPluginCodeFromTest();
        }

        if (isset($this->pluginTestCaseLoadedPlugins[$code])) {
            return $this->pluginTestCaseLoadedPlugins[$code];
        }
    }

    /**
     * The models in October use a static property to store their events, these
     * will need to be targeted and reset ready for a new test cycle.
     * Pivot models are an exception since they are internally managed.
     *
     * @return void
     * @throws \ReflectionException
     */
    protected function flushModelEventListeners()
    {
        foreach (get_declared_classes() as $class) {
            if ($class == 'October\Rain\Database\Pivot') {
                continue;
            }

            $reflectClass = new ReflectionClass($class);
            if (
                !$reflectClass->isInstantiable() ||
                !$reflectClass->isSubclassOf('October\Rain\Database\Model') ||
                $reflectClass->isSubclassOf('October\Rain\Database\Pivot')
            ) {
                continue;
            }

            $class::flushEventListeners();
        }

        ActiveRecord::flushEventListeners();
    }

    /**
     * Locates the plugin code based on the test file location.
     *
     * @return string|bool
     * @throws \ReflectionException
     */
    protected function guessPluginCodeFromTest()
    {
        $reflect = new ReflectionClass($this);
        $path = $reflect->getFilename();
        $basePath = $this->app->pluginsPath();

        $result = false;

        if (strpos($path, $basePath) === 0) {
            $result = ltrim(str_replace('\\', '/', substr($path, strlen($basePath))), '/');
            $result = implode('.', array_slice(explode('/', $result), 0, 2));
        }

        return $result;
    }
}
