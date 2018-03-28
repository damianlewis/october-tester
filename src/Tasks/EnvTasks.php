<?php

namespace DamianLewis\OctoberTesting\Tasks;

use Dotenv\Dotenv;

trait EnvTasks
{
    /**
     * Backup the current environment file and switch to the testing environment.
     *
     * @return void
     */
    protected function switchEnvironment()
    {
        copy(base_path('.env'), base_path('.env.backup'));

        copy(base_path($this->envTestingFile()), base_path('.env'));
    }

    /**
     * Restore the backed-up environment file.
     *
     * @return void
     */
    protected function restoreEnvironment()
    {
        copy(base_path('.env.backup'), base_path('.env'));

        unlink(base_path('.env.backup'));
    }

    /**
     * Refresh the current environment variables.
     *
     * @return void
     */
    protected function refreshEnvironment()
    {
        (new Dotenv(base_path()))->overload();
    }

    /**
     * Get the name of the testing file for the environment.
     *
     * @return string
     */
    protected function envTestingFile()
    {
        return '.env.testing';
    }
}
