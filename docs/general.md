# General Usage

## Accounts

#### Generate a new account

```php
$arionum->generateAccount();
```

#### Generate a new account locally

```php
$arionum->generateLocalAccount();
```

#### Get an address from a public key

```php
$arionum->getAddress('public-key');
```

#### Get the alias for a specific address

```php
$arionum->getAlias('address');
```

#### Get the public key for an address

```php
$arionum->getPublicKey('address');
```

#### Get the balance for an address

```php
$arionum->getBalance('address');
```

#### Get the pending balance for an address

```php
$arionum->getPendingBalance('address');
```

## Transactions

#### Get a list of transactions for an address

```php
$arionum->getTransactions('address');
```

#### Get a list of transactions for a public key

```php
$arionum->getTransactionsByPublicKey('address');
```

#### Get a specific transaction by its id

```php
$arionum->getTransaction('transaction-id');
```

## Blocks

#### Get the current block

```php
$arionum->getCurrentBlock();
```

#### Get a specific block by its height

```php
$arionum->getBlock(1);
```

#### Get transactions for a specific block

```php
$arionum->getBlockTransactions('block-id');
```

## Masternodes

#### Get a list of available masternodes on the network

```php
$arionum->getMasternodes();
```

## Node Details

#### Get details about the node

```php
$arionum->getNodeInfo();
```

#### Get the version of the current node

```php
$arionum->getNodeVersion();
```

#### Get details about the nodes sanity process

```php
$arionum->getSanityDetails();
```

#### Get the number of transactions in the mempool

```php
$arionum->getMempoolSize();
```

## Other

#### Get a Base58-encoded version of a string

```php
$arionum->getBase58('string-data');
```

#### Check the validity of an address

```php
$arionum->checkAddress('address');
```

#### Check the validity of a signature

```php
$arionum->checkSignature('signature', 'data', 'public_key');
```

#### Get a random number based on a specified block

```php
$arionum->getRandomNumber(1, 1, 1000);
```
