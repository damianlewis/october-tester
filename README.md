## Introduction

October Tester is a testing API and browser automation for testing applications built with OctoberCMS. It makes use of both the [Laravel HTTP Testing](https://laravel.com/docs/5.5/http-tests) API and the [Laravel Dusk](https://github.com/laravel/dusk) API along with the Selenium WebDriver bindings for PHP. It requires Selenium to be installed on the testing machine.

## Installation

Add the October Tester dependency to your project as a Composer development requirement. 
```bash
composer require --dev damianlewis/october-tester
```

Once installed, you should register the `DamianLewis\OctoberTester\OctoberTesterServiceProvider` service provider and run the `octobertester:install` Artisan command.
```bash
php artisan octobertester:install
```

A Browser directory will be created within your tests directory. Next, set the APP_URL environment variable in your .env file. This value should match the URL you use to access your application in a browser.

A `config/webdriver.php` file is installed to allow webdriver configurations to be made.