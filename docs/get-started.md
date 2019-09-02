# Getting Started

> **Requires:** [PHP 7.2 or later](https://php.net/releases)

First, install Arionum PHP via the `Composer` package manager:

```bash
composer require pxgamer/arionum-php
```

### Set up the Arionum instance

```php
$nodeUri = 'https://node-uri-here';
$arionum = new pxgamer\Arionum\Arionum($nodeUri);
```

### Within Laravel

For use within Laravel, there is a [Laravel Arionum][link-laravel-arionum] adapter:

```bash
# Require the Laravel adapter package
composer require pxgamer/laravel-arionum

# Publish the configuration file
php artisan vendor:publish --provider="pxgamer\LaravelArionum\ArionumServiceProvider"
```

To configure the Arionum node that is used, set the `ARIONUM_NODE_URI` environment variable in `.env` file.

[link-laravel-arionum]: https://github.com/pxgamer/laravel-arionum
