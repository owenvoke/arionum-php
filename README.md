# arionum-php

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Style CI][ico-styleci]][link-styleci]
[![Code Coverage][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

An API wrapper for the Arionum cryptocurrency node.

## Install

Via Composer

```bash
$ composer require pxgamer/arionum-php
```

## Usage

**Set the node base URI**

```php
$arionum = new pxgamer\Arionum\Arionum();
$arionum->setNodeAddress('https://node-uri-here');
```

**Get an address from a public key**

```php
$arionum->getAddress('public-key');
```

**Get a Base58-encoded version of a string**

```php
$arionum->getBase58('string-data');
```

**Get the balance for an address**

```php
$arionum->getBalance('address');
```

**Get the pending balance for an address**

```php
$arionum->getPendingBalance('address');
```

**Get the transactions for an address**

```php
$arionum->getTransactions('address');
```

**Get the transaction by its id**

```php
$arionum->getTransaction('transaction-id');
```

**Get the public key for an address**

```php
$arionum->getPublicKey('address');
```

**Generate a new account**

```php
$arionum->generateAccount();
```

**Get the current block**

```php
$arionum->getCurrentBlock();
```

**Get a specific block by its height**

```php
$arionum->getBlock(1);
```

**Get transactions for a specific block**

```php
$arionum->getBlockTransactions('block-id');
```

**Get version of the current node**

```php
$arionum->getNodeVersion();
```

**Get the number of transactions in the mempool**

```php
$arionum->getMempoolSize();
```

**Get a random number based on a specified block**

```php
$arionum->getRandomNumber(1, 1, 1000);
```

**Get a list of available masternodes on the network**

```php
$arionum->getMasternodes();
```

**Get the alias for a specific address**

```php
$arionum->getAlias('address');
```
**Send()**
```$transaction = new Transaction();

$transaction->setValue(1);
$transaction->setDestinationAddress('...'); 
$transaction->setPublicKey('...');
$transaction->setSignature('...');
$transaction->setMessage('...');
$transaction->setDate(time());

$arionum->sendTransaction($transaction);```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

```bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) and [CODE_OF_CONDUCT](.github/CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email owzie123@gmail.com instead of using the issue tracker.

## Credits

- [pxgamer][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/pxgamer/arionum-php.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/pxgamer/arionum-php/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/138864423/shield
[ico-code-quality]: https://img.shields.io/codecov/c/github/pxgamer/arionum-php.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/pxgamer/arionum-php.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/pxgamer/arionum-php
[link-travis]: https://travis-ci.com/pxgamer/arionum-php
[link-styleci]: https://styleci.io/repos/138864423
[link-code-quality]: https://codecov.io/gh/pxgamer/arionum-php
[link-downloads]: https://packagist.org/packages/pxgamer/arionum-php
[link-author]: https://github.com/pxgamer
[link-contributors]: ../../contributors
