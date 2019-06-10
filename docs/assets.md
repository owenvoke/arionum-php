# Assets

> The asset system is currently in testnet. These methods require a testnet node instance to use.

#### Check the asset balances for an address

```php
// Returns an array of asset balances
$arionum->getAssetBalance($address);
```

#### Retrieve a list of registered assets

```php
// Returns an array of assets
$arionum->getAssets();
```

#### Retrieve an asset by its id

```php
// Returns an array of assets
$arionum->getAsset($assetId);
```
