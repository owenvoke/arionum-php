<?php

declare(strict_types=1);

namespace pxgamer\Arionum\Transaction;

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

        return self::configureMasternodeCommandDefaults($address, $transaction);
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

        return self::configureMasternodeCommandDefaults($address, $transaction);
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

        return self::configureMasternodeCommandDefaults($address, $transaction);
    }

    /**
     * Set the default fee and value for masternode commands.
     *
     * @param  string  $address
     * @param  Transaction  $transaction
     *
     * @return Transaction
     */
    private static function configureMasternodeCommandDefaults(string $address, Transaction $transaction): Transaction
    {
        $transaction->changeDestinationAddress($address);
        $transaction->changeValue(Transaction::VALUE_MASTERNODE_COMMAND);
        $transaction->changeFee(Transaction::FEE_MASTERNODE_COMMAND);

        return $transaction;
    }
}
