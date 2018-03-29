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

namespace DamianLewis\OctoberTester\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'octobertester:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install OctoberTester into the application';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!is_dir(base_path('tests/Browser/screenshots'))) {
            $this->createScreenshotsDirectory();
        }

        if (!is_dir(base_path('tests/Browser/console'))) {
            $this->createConsoleDirectory();
        }

        $stubs = [
            'webdriver.stub'          => base_path('config/webdriver.php'),
            'CreatesApplication.stub' => base_path('tests/CreatesApplication.php'),
            'TestCase.stub'           => base_path('tests/TestCase.php'),
            'UiTestCase.stub'         => base_path('tests/UiTestCase.php')
        ];

        foreach ($stubs as $stub => $file) {
            if (!is_file($file)) {
                copy(__DIR__ . '/../../stubs/' . $stub, $file);
            }
        }

        $this->info('OctoberTester scaffolding installed successfully.');
    }

    /**
     * Create the screenshots directory.
     *
     * @return void
     */
    protected function createScreenshotsDirectory()
    {
        mkdir(base_path('tests/Browser/screenshots'), 0755, true);

        file_put_contents(base_path('tests/Browser/screenshots/.gitignore'), '*
!.gitignore
');
    }

    /**
     * Create the console directory.
     *
     * @return void
     */
    protected function createConsoleDirectory()
    {
        mkdir(base_path('tests/Browser/console'), 0755, true);

        file_put_contents(base_path('tests/Browser/console/.gitignore'), '*
!.gitignore
');
    }
}
