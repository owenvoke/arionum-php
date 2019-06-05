# Sending Transactions

### Creating a transaction instance

There are many transaction helpers for creating pre-filled `Transaction` instances.

```php
use pxgamer\Arionum\Transaction\TransactionFactory;

// Retrieve a pre-populated Transaction instance for sending to an alias
TransactionFactory::makeAliasSendInstance($alias, $value, $message);

// Retrieve a pre-populated Transaction instance for setting an alias
TransactionFactory::makeAliasSetInstance($address, $alias);

// Retrieve a pre-populated Transaction instance for creating a masternode
TransactionFactory::makeMasternodeCreateInstance($ipAddress, $address);

// Retrieve a pre-populated Transaction instance for pausing a masternode
TransactionFactory::makeMasternodePauseInstance($address);

// Retrieve a pre-populated Transaction instance for resuming a masternode
TransactionFactory::makeMasternodeResumeInstance($address);

// Retrieve a pre-populated Transaction instance for releasing a masternode
TransactionFactory::makeMasternodeReleaseInstance($address);
```

**Manually creating a transaction**

```php
$transaction = new Transaction();

$transaction->changeDestinationAddress($address); // The address to send to
$transaction->changeValue($value); // The value as a float
$transaction->changeFee($fee); // The fee as a float
$transaction->changePublicKey($publicKey); // The public key the transaction is sent from
$transaction->changeSignature($signature); // The signature created from local signing
$transaction->changeDate($date); // The date as a unix timestamp
$transaction->changeMessage($message); // The message for the transaction
$transaction->changeVersion($version); // The version of the transaction

// This is the non-recommended way, the private key will be sent to the node
// Using local signing with `changeSignature()` is preferred
$transaction->changePrivateKey($privateKey);
```

### Send a transaction

```php
// This will send the transaction instance to the node
$arionum->sendTransaction($transaction);
```

### Transaction versions

The `Transaction\Version` class contains constants for all available transaction versions.
