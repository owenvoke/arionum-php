<?php

declare(strict_types=1);

namespace pxgamer\Arionum\Transaction;

use pxgamer\Arionum\Transaction;

final class TransactionFactory
{
    /**
     * Retrieve a pre-populated Transaction instance for sending to an alias.
     *
     * @param  string  $alias
     * @param  float  $value
     * @param  string  $message
     *
     * @return Transaction
     */
    public static function makeAliasSendInstance(string $alias, float $value, string $message = ''): Transaction
    {
        $transaction = new Transaction();

        $transaction->setVersion(Version::ALIAS_SEND);
        $transaction->setDestinationAddress($alias);
        $transaction->setValue($value);
        $transaction->setMessage($message);

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

        $transaction->setVersion(Version::ALIAS_SET);
        $transaction->setDestinationAddress($address);
        $transaction->setValue(Transaction::VALUE_ALIAS_SET);
        $transaction->setFee(Transaction::FEE_ALIAS_SET);
        $transaction->setMessage($alias);

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

        $transaction->setVersion(Version::MASTERNODE_CREATE);
        $transaction->setDestinationAddress($address);
        $transaction->setValue(Transaction::VALUE_MASTERNODE_CREATE);
        $transaction->setFee(Transaction::FEE_MASTERNODE_CREATE);
        $transaction->setMessage($ipAddress);

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

        $transaction->setVersion(Version::MASTERNODE_PAUSE);

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

        $transaction->setVersion(Version::MASTERNODE_RESUME);

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

        $transaction->setVersion(Version::MASTERNODE_RELEASE);

        return self::setMasternodeCommandDefaults($address, $transaction);
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
        $transaction->setDestinationAddress($address);
        $transaction->setValue(Transaction::VALUE_MASTERNODE_COMMAND);
        $transaction->setFee(Transaction::FEE_MASTERNODE_COMMAND);

        return $transaction;
    }
}
