<?php

namespace DamianLewis\OctoberTesting\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'octobertesting:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install October Testing into the application';

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
            'webdriver.stub'               => base_path('config/webdriver.php'),
            'CreatesApplication.stub'      => base_path('tests/CreatesApplication.php'),
            'PluginTestCase.stub'          => base_path('tests/PluginTestCase.php'),
            'PluginWebDriverTestCase.stub' => base_path('tests/PluginWebDriverTestCase.php')
        ];

        foreach ($stubs as $stub => $file) {
            if (!is_file($file)) {
                copy(__DIR__ . '/../../stubs/' . $stub, $file);
            }
        }

        $this->info('October Testing scaffolding installed successfully.');
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
