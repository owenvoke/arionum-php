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

The package will be discovered automatically, but the configuration can be duplicated using:

```bash
php artisan vendor:publish --provider="pxgamer\Arionum\Laravel\ArionumServiceProvider"
```

To configure the Arionum node that is used, set the `ARIONUM_NODE_URI` environment variable in `.env`
