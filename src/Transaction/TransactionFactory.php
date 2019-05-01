<?php

declare(strict_types=1);

namespace pxgamer\Arionum\Transaction;

use pxgamer\Arionum\Entity\Asset;
use pxgamer\Arionum\Models\Transaction;

final class TransactionFactory
{
    /**
     * Retrieve a pre-populated Transaction instance for sending to an alias.
     *
     * @param  string  $alias
     * @param  float  $value
     * @param  string|null  $message
     *
     * @return Transaction
     */
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

    /**
     * Retrieve a pre-populated Transaction instance for setting an alias.
     *
     * @param  string  $address
     * @param  string  $alias
     *
     * @return Transaction
     */
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

    /**
     * Retrieve a pre-populated Transaction instance for creating a masternode.
     *
     * @param  string  $ipAddress
     * @param  string  $address
     *
     * @return Transaction
     */
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

    /**
     * Retrieve a pre-populated Transaction instance for pausing a masternode.
     *
     * @param  string  $address
     *
     * @return Transaction
     */
    public static function makeMasternodePauseInstance(string $address): Transaction
    {
        $transaction = new Transaction();

        $transaction->changeVersion(Version::MASTERNODE_PAUSE);

        return self::setMasternodeCommandDefaults($address, $transaction);
    }

    /**
     * Retrieve a pre-populated Transaction instance for resuming a masternode.
     *
     * @param  string  $address
     *
     * @return Transaction
     */
    public static function makeMasternodeResumeInstance(string $address): Transaction
    {
        $transaction = new Transaction();

        $transaction->changeVersion(Version::MASTERNODE_RESUME);

        return self::setMasternodeCommandDefaults($address, $transaction);
    }

    /**
     * Retrieve a pre-populated Transaction instance for releasing a masternode.
     *
     * @param  string  $address
     *
     * @return Transaction
     */
    public static function makeMasternodeReleaseInstance(string $address): Transaction
    {
        $transaction = new Transaction();

        $transaction->changeVersion(Version::MASTERNODE_RELEASE);

        return self::setMasternodeCommandDefaults($address, $transaction);
    }

    /**
     * Retrieve a pre-populated Transaction instance for creating an asset.
     *
     * @param  Asset  $asset
     *
     * @return Transaction
     */
    public static function makeAssetCreateInstance(
        Asset $asset
    ): Transaction {
        $transaction = new Transaction();

        $transaction->changeVersion(Version::ASSET_CREATE);
        $transaction->changeMessage((string) $asset);
        $transaction->changeValue(100);

        return $transaction;
    }

    /**
     * Retrieve a pre-populated Transaction instance for sending an asset.
     *
     * @param  string  $assetId
     * @param  string  $destination
     * @param  float  $value
     *
     * @return Transaction
     */
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

    /**
     * Retrieve a pre-populated Transaction instance for creating a market order for an asset.
     *
     * @param  string  $assetId
     * @param  float  $price
     * @param  float  $assetAmount
     * @param  int  $orderType
     * @param  bool  $isCancelable
     *
     * @return Transaction
     */
    public static function makeAssetMarketInstance(
        string $assetId,
        float $price,
        float $assetAmount,
        int $orderType,
        bool $isCancelable
    ): Transaction {
        $transaction = new Transaction();

        $transaction->changeVersion(Version::ASSET_MARKET);
        $transaction->changeMessage(json_encode([$assetId, $price, $assetAmount, $isCancelable, $orderType]));
        $transaction->changeValue(0.00000001);

        return $transaction;
    }

    /**
     * Retrieve a pre-populated Transaction instance for cancelling a market order for an asset.
     *
     * @param  string  $orderId
     *
     * @return Transaction
     */
    public static function makeAssetCancelOrderInstance(string $orderId): Transaction
    {
        $transaction = new Transaction();

        $transaction->changeVersion(Version::ASSET_CANCEL_ORDER);
        $transaction->changeMessage($orderId);
        $transaction->changeValue(0.00000001);

        return $transaction;
    }

    /**
     * Retrieve a pre-populated Transaction instance for sending dividends for an asset.
     *
     * @param  float  $value
     *
     * @return Transaction
     */
    public static function makeAssetDividendsInstance(float $value): Transaction
    {
        $transaction = new Transaction();

        $transaction->changeVersion(Version::ASSET_DIVIDENDS);
        $transaction->changeMessage('');
        $transaction->changeValue($value);

        return $transaction;
    }

    /**
     * Set the default fee and value for masternode commands.
     *
     * @param  string  $address
     * @param  Transaction  $transaction
     *
     * @return Transaction
     */
    private static function setMasternodeCommandDefaults(string $address, Transaction $transaction): Transaction
    {
        $transaction->changeDestinationAddress($address);
        $transaction->changeValue(Transaction::VALUE_MASTERNODE_COMMAND);
        $transaction->changeFee(Transaction::FEE_MASTERNODE_COMMAND);

        return $transaction;
    }
}
