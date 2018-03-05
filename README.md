## Introduction

OctoberTesting provides an expressive, easy-to-use browser automation and testing API for apps built with OctoberCMS. It is based on [Laravel Dusk](https://github.com/laravel/dusk) and uses the Selenium WebDriver bindings for PHP. It requires you to install Selenium on your machine.

## Installation

Once OctoberTesting is installed, you should register the `DamianLewis\OctoberTesting\OctoberTestingServiceProvider` service provider and run the `octobertesting:install` Artisan command.
```bash
php artisan octobertesting:install
```

A Browser directory will be created within your tests directory. Next, set the APP_URL environment variable in your .env file. This value should match the URL you use to access your application in a browser.

A `config/webdriver.php` file is installed to allow webdriver configurations to be made.