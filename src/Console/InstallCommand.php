<?php

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
            'webdriver.stub'  => base_path('config/webdriver.php'),
            'TestCase.stub'   => base_path('tests/TestCase.php'),
            'UiTestCase.stub' => base_path('tests/UiTestCase.php')
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
