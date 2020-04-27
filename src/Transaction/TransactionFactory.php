<?php

declare(strict_types=1);

namespace OwenVoke\Arionum\Transaction;

use OwenVoke\Arionum\Models\Asset;
use OwenVoke\Arionum\Models\Transaction;

final class TransactionFactory
{
    /* Retrieve a pre-populated Transaction instance for sending to an alias */
    public static function makeAliasSendInstance(string $alias, float $value, ?string $message = null): Transaction
    {
        $message = $message ?? '';

        $transaction = new Transaction();

        $transaction->changeVersion(Version::ALIAS_SEND);
        $transaction->changeDestinationAddress($alias);
        $transaction->changeValue($value);
        $transaction->changeMessage($message);

        return $transaction;
    }

    /* Retrieve a pre-populated Transaction instance for setting an alias */
    public static function makeAliasSetInstance(string $address, string $alias): Transaction
    {
        $transaction = new Transaction();

        $transaction->changeVersion(Version::ALIAS_SET);
        $transaction->changeDestinationAddress($address);
        $transaction->changeValue(Transaction::VALUE_ALIAS_SET);
        $transaction->changeFee(Transaction::FEE_ALIAS_SET);
        $transaction->changeMessage($alias);

        return $transaction;
    }

    /* Retrieve a pre-populated Transaction instance for creating a masternode */
    public static function makeMasternodeCreateInstance(string $ipAddress, string $address): Transaction
    {
        $transaction = new Transaction();

        $transaction->changeVersion(Version::MASTERNODE_CREATE);
        $transaction->changeDestinationAddress($address);
        $transaction->changeValue(Transaction::VALUE_MASTERNODE_CREATE);
        $transaction->changeFee(Transaction::FEE_MASTERNODE_CREATE);
        $transaction->changeMessage($ipAddress);

        return $transaction;
    }

    /* Retrieve a pre-populated Transaction instance for pausing a masternode */
    public static function makeMasternodePauseInstance(string $address): Transaction
    {
        $transaction = new Transaction();

        $transaction->changeVersion(Version::MASTERNODE_PAUSE);

        return self::configureMasternodeCommandDefaults($address, $transaction);
    }

    /* Retrieve a pre-populated Transaction instance for resuming a masternode */
    public static function makeMasternodeResumeInstance(string $address): Transaction
    {
        $transaction = new Transaction();

        $transaction->changeVersion(Version::MASTERNODE_RESUME);

        return self::configureMasternodeCommandDefaults($address, $transaction);
    }

    /* Retrieve a pre-populated Transaction instance for releasing a masternode */
    public static function makeMasternodeReleaseInstance(string $address): Transaction
    {
        $transaction = new Transaction();

        $transaction->changeVersion(Version::MASTERNODE_RELEASE);

        return self::configureMasternodeCommandDefaults($address, $transaction);
    }

    /* Retrieve a pre-populated Transaction instance for creating an asset */
    public static function makeAssetCreateInstance(
        Asset $asset
    ): Transaction {
        $transaction = new Transaction();

        $transaction->changeVersion(Version::ASSET_CREATE);
        $transaction->changeMessage((string) $asset);
        $transaction->changeValue(100);

        return $transaction;
    }

    /* Retrieve a pre-populated Transaction instance for sending an asset */
    public static function makeAssetSendInstance(
        string $assetId,
        string $destination,
        float $value
    ): Transaction {
        $transaction = new Transaction();

        $transaction->changeDestinationAddress($destination);
        $transaction->changeVersion(Version::ASSET_SEND);
        $transaction->changeMessage(json_encode([$assetId, $value]));
        $transaction->changeValue(0.00000001);

        return $transaction;
    }

    /* Retrieve a pre-populated Transaction instance for creating a market order for an asset */
    public static function makeAssetMarketInstance(
        string $assetId,
        float $price,
        float $assetAmount,
        string $orderType,
        bool $isCancelable
    ): Transaction {
        $transaction = new Transaction();

        $transaction->changeVersion(Version::ASSET_MARKET);
        $transaction->changeMessage(json_encode([$assetId, $price, $assetAmount, $isCancelable, $orderType]));
        $transaction->changeValue(0.00000001);

        return $transaction;
    }

    /* Retrieve a pre-populated Transaction instance for cancelling a market order for an asset */
    public static function makeAssetCancelOrderInstance(string $orderId): Transaction
    {
        $transaction = new Transaction();

        $transaction->changeVersion(Version::ASSET_CANCEL_ORDER);
        $transaction->changeMessage($orderId);
        $transaction->changeValue(0.00000001);

        return $transaction;
    }

    /* Retrieve a pre-populated Transaction instance for sending dividends for an asset */
    public static function makeAssetDividendsInstance(float $value): Transaction
    {
        $transaction = new Transaction();

        $transaction->changeVersion(Version::ASSET_DIVIDENDS);
        $transaction->changeMessage('');
        $transaction->changeValue($value);

        return $transaction;
    }

    /* Retrieve a pre-populated Transaction instance for sending dividends for an asset */
    public static function makeAssetInflateInstance(float $assetAmount): Transaction
    {
        $transaction = new Transaction();

        $transaction->changeVersion(Version::ASSET_INFLATE);
        $transaction->changeMessage((string) $assetAmount);
        $transaction->changeValue(0.00000001);

        return $transaction;
    }

    /* Set the default fee and value for masternode commands */
    private static function configureMasternodeCommandDefaults(string $address, Transaction $transaction): Transaction
    {
        $transaction->changeDestinationAddress($address);
        $transaction->changeValue(Transaction::VALUE_MASTERNODE_COMMAND);
        $transaction->changeFee(Transaction::FEE_MASTERNODE_COMMAND);

        return $transaction;
    }
}
