## Introduction

OctoberTester is a testing API and browser automation for testing applications built with OctoberCMS. It makes use of both the [Laravel testing API](https://laravel.com/docs/5.5/http-tests) and the [Laravel Dusk](https://github.com/laravel/dusk) framework along with the Selenium WebDriver bindings for PHP. It requires Selenium to be installed on the testing machine.

## Installation

Add the `damianlewis/OctoberTester` Composer dependency to your project as a development requirement. Once installed, you should register the `DamianLewis\OctoberTester\OctoberTesterServiceProvider` service provider and run the `octobertester:install` Artisan command.
```bash
php artisan octobertester:install
```

A Browser directory will be created within your tests directory. Next, set the APP_URL environment variable in your .env file. This value should match the URL you use to access your application in a browser.

A `config/webdriver.php` file is installed to allow webdriver configurations to be made.