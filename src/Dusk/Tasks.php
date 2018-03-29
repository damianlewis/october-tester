<?php
//The MIT License (MIT)
//
//Copyright (c) Taylor Otwell
//
//Permission is hereby granted, free of charge, to any person obtaining a copy
//of this software and associated documentation files (the "Software"), to deal
//in the Software without restriction, including without limitation the rights
//to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
//copies of the Software, and to permit persons to whom the Software is
//furnished to do so, subject to the following conditions:
//
//The above copyright notice and this permission notice shall be included in
//all copies or substantial portions of the Software.
//
//THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
//IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
//FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
//AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
//LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
//OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
//THE SOFTWARE.

namespace DamianLewis\OctoberTester\Dusk;

use Dotenv\Dotenv;

trait Tasks
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