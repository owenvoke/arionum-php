# Usage

**Set the node base URI**

```php
$arionum = new pxgamer\Arionum\Arionum('https://node-uri-here');
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

**Get the transactions for a public key**

```php
$arionum->getTransactionsByPublicKey('address');
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

**Send a transaction**

```php
$transaction = new Transaction();

$transaction->setValue(1);
$transaction->setDestinationAddress('...'); 
$transaction->setPublicKey('...');
$transaction->setSignature('...');
$transaction->setMessage('...');
$transaction->setDate(time());

$arionum->sendTransaction($transaction);
```

**Get details about the nodes sanity process**

```php
$arionum->getSanityDetails();
```

**Get details about the node**

```php
$arionum->getNodeInfo();
```

**Check the validity of a signature**

```php
$arionum->checkSignature('signature', 'data', 'public_key');
```

**Check the validity of an address**

```php
$arionum->checkAddress('address');
```

**Check the asset balances for an address**

> Testnet only at the moment.

```php
$arionum->getAssetBalance('address');
```
