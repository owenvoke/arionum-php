# Changelog

All notable changes to `arionum-php` will be documented in this file.

Updates should follow the [Keep a CHANGELOG](https://keepachangelog.com) principles.

## [Unreleased]

## [v3.0.0-beta.1] - 2019-06-05

### Added
- Add Laravel support ([#38](https://github.com/pxgamer/arionum-php/pull/38))
- Add new Transaction helpers for the asset system ([#25](https://github.com/pxgamer/arionum-php/pull/25))

### Changed
- Move factory methods to a `TransactionFactory` class ([#34](https://github.com/pxgamer/arionum-php/pull/34))
- Move exceptions to an `Exceptions` namespace ([#35](https://github.com/pxgamer/arionum-php/pull/35))
- Replace setter methods with `change` methods ([#36](https://github.com/pxgamer/arionum-php/pull/36))
- Update to use VuePress for the documentation ([#37](https://github.com/pxgamer/arionum-php/pull/37))

### Removed
- Refactor Transaction private property names ([#32](https://github.com/pxgamer/arionum-php/pull/32))
- Remove deprecated Transaction class constants ([#31](https://github.com/pxgamer/arionum-php/pull/31))

## [v2.7.0] - 2019-05-30

### Added
- Add new 'change' methods to replace the setters ([#36](https://github.com/pxgamer/arionum-php/pull/36))

### Changed
- Move factory methods to a Transaction factory ([#34](https://github.com/pxgamer/arionum-php/pull/34))
- Move exceptions to an Exceptions namespace ([#35](https://github.com/pxgamer/arionum-php/pull/35))

### Deprecated
- Deprecate factory methods on the `Transaction` class ([#34](https://github.com/pxgamer/arionum-php/pull/34))
- Deprecate the old `ApiException` class ([#35](https://github.com/pxgamer/arionum-php/pull/35))
- Deprecate the old `set` methods on the `Transaction` class ([#36](https://github.com/pxgamer/arionum-php/pull/36))

## [v2.6.0] - 2019-05-24

### Added
- Add new accessor methods for the `Transaction` class ([#30](https://github.com/pxgamer/arionum-php/pull/30))

### Changed
- Update to apply code style fixes from PHP Insights and Psalm ([#26](https://github.com/pxgamer/arionum-php/pull/26))

### Deprecated
- Deprecate public methods on the `Transaction` class ([#30](https://github.com/pxgamer/arionum-php/pull/30))

### Removed
- Remove PHP CodeSniffer development dependency ([#28](https://github.com/pxgamer/arionum-php/pull/28))
- Remove PHPUnit 7 development dependency ([#29](https://github.com/pxgamer/arionum-php/pull/29))

## [v2.5.0] - 2019-04-24

### Added
- Add a new `Transaction\Version` class for version constants ([#21](https://github.com/pxgamer/arionum-php/pull/21))
- Add the `getAssetBalance` method ([#23](https://github.com/pxgamer/arionum-php/pull/23))

### Deprecated
- Deprecate the `VERSION_*` constants on the `Tranasction` class ([#21](https://github.com/pxgamer/arionum-php/pull/21))

## [v2.4.0] - 2019-03-04

### Added
- Add support for PHPUnit 8 ([#20](https://github.com/pxgamer/arionum-php/issues/20))

## [v2.3.0] - 2019-02-28

### Changed
- Move documentation from the README to a `docs` directory ([#14](https://github.com/pxgamer/arionum-php/issues/14))
- Update source files to use strict typing ([15705d4](https://github.com/pxgamer/arionum-php/commit/15705d4c534f97af20812d279f5ddd57ab1dc7f4))
- Update test files to use strict typing ([b49b3d0](https://github.com/pxgamer/arionum-php/commit/b49b3d0fe15b618ce6c3f1595c4066f80f78a4ae))

### Removed
- Remove PHP 7.1 support ([c90e3dd](https://github.com/pxgamer/arionum-php/commit/c90e3ddec32bf830e099a1416f2c5af329247497))
- Remove PHPUnit 6 support ([e35f0a8](https://github.com/pxgamer/arionum-php/commit/e35f0a84d4f415aa46e1722d43bdaf48a09fc6da))

## [v2.2.0] - 2018-11-05

### Added
- Add the `checkSignature` method ([#11](https://github.com/pxgamer/arionum-php/issues/11))
- Add new helper generation methods for the `Transaction` class ([#10](https://github.com/pxgamer/arionum-php/issues/10))
- Add the `checkAddress` method ([#17](https://github.com/pxgamer/arionum-php/issues/17))
- Add the `getTransactionsByPublicKey` method ([#9](https://github.com/pxgamer/arionum-php/issues/9))
- Add the `getBalanceByAlias` and `getBalanceByPublicKey` methods ([#8](https://github.com/pxgamer/arionum-php/issues/8))

## [v2.1.0] - 2018-10-13

### Added
- Add an optional `limit` parameter to the `getTransactions` method ([64c9a69](https://github.com/pxgamer/arionum-php/commit/64c9a694ac5c2b8a1b18f1ace438b0eda28e2990))
- Add the `getSanityDetails` method ([f5a87ac](https://github.com/pxgamer/arionum-php/commit/f5a87acb3efcb57291e619d04bcab3638339fdaf))
- Add the `getNodeInfo` method ([71fa043](https://github.com/pxgamer/arionum-php/commit/71fa043d264fced09236a1352ca0772797a148a6))

## [v2.0.0] - 2018-10-11

### Added
- Add support for custom `Guzzle\ClientInterface` instance in constructor ([ead482fa](https://github.com/pxgamer/arionum-php/commit/ead482faafc4bec6da8aed244911dd7933c456d9))

### Removed
- Remove the `setNodeAddress` method from the `Arionum` class ([30e0ae4a](https://github.com/pxgamer/arionum-php/commit/30e0ae4a2fb13c41f62971bc8b95a86914ad7246))
- Remove unnecessary `base_uri` definition for Guzzle ([a035dd3f](https://github.com/pxgamer/arionum-php/commit/a035dd3f6243b2b9c651f56439d3ab90037c666b))

## [v1.4.0] - 2018-10-09

### Added
- Add a constructor method for the `Arionum` class ([aec52f7e](https://github.com/pxgamer/arionum-php/commit/aec52f7ec5eab75790a83a960354cfa7a40d79fd))

### Deprecated
- Add notice of deprecation for the `setNodeAddress()` method ([7ae3927f](https://github.com/pxgamer/arionum-php/commit/7ae3927fa607adf4eba6d6bee9cb6a470beaf044))

## [v1.3.0] - 2018-08-28

### Added
- Add support for the `masternodes` method ([#4](https://github.com/pxgamer/arionum-php/issues/4))
- Add support for the `getAlias` method ([#5](https://github.com/pxgamer/arionum-php/issues/5))

## [v1.2.0] - 2018-08-06

### Changed
- Allow method chaining for Transactions ([#3](https://github.com/pxgamer/arionum-php/issues/3))
- Rename some variable names in the Transaction class ([6fb2d33](https://github.com/pxgamer/arionum-php/commit/6fb2d33542c74d9daf6d972a0d429986a49b0e22))

## [v1.1.2] - 2018-07-17

### Changed
- Allow build failures on Nightly builds ([e69cf12](https://github.com/pxgamer/arionum-php/commit/e69cf1243c40e8fa6fc0aa80676c4298fcaf2722))

## [v1.1.1] - 2018-07-17

### Changed
- Refactor all unit tests into separate classes ([589d589](https://github.com/pxgamer/arionum-php/commit/589d589ab734ee8243c73e9538248bb9b5b9109d))
- Refactor the names of the unit test methods ([589d589](https://github.com/pxgamer/arionum-php/commit/589d589ab734ee8243c73e9538248bb9b5b9109d))

## [v1.1.0] - 2018-06-28

### Added
- Add the send method ([#1](https://github.com/pxgamer/arionum-php/issues/1))

### Changed
- Remove exception line that will never be reached ([82d2f1f](https://github.com/pxgamer/arionum-php/commit/82d2f1f7ba38d63c288e9931c355d62a5e653a75))

## v1.0.0 - 2018-06-27

### Added
- Initial release

[Unreleased]: https://github.com/pxgamer/arionum-php/compare/master...develop
[v2.7.0]: https://github.com/pxgamer/arionum-php/compare/v2.6.0...v2.7.0
[v2.6.0]: https://github.com/pxgamer/arionum-php/compare/v2.5.0...v2.6.0
[v2.5.0]: https://github.com/pxgamer/arionum-php/compare/v2.4.0...v2.5.0
[v2.4.0]: https://github.com/pxgamer/arionum-php/compare/v2.3.0...v2.4.0
[v2.3.0]: https://github.com/pxgamer/arionum-php/compare/v2.2.0...v2.3.0
[v2.2.0]: https://github.com/pxgamer/arionum-php/compare/v2.1.0...v2.2.0
[v2.1.0]: https://github.com/pxgamer/arionum-php/compare/v2.0.0...v2.1.0
[v2.0.0]: https://github.com/pxgamer/arionum-php/compare/v1.4.0...v2.0.0
[v1.4.0]: https://github.com/pxgamer/arionum-php/compare/v1.3.0...v1.4.0
[v1.3.0]: https://github.com/pxgamer/arionum-php/compare/v1.2.0...v1.3.0
[v1.2.0]: https://github.com/pxgamer/arionum-php/compare/v1.1.2...v1.2.0
[v1.1.2]: https://github.com/pxgamer/arionum-php/compare/v1.1.1...v1.1.2
[v1.1.1]: https://github.com/pxgamer/arionum-php/compare/v1.1.0...v1.1.1
[v1.1.0]: https://github.com/pxgamer/arionum-php/compare/v1.0.0...v1.1.0
