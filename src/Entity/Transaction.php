<?php

declare(strict_types=1);

namespace pxgamer\Arionum;

/**
 * Class Transaction
 */
final class Transaction
{
    /** @var int The transaction version for sending to an address. */
    public const VERSION_STANDARD = 1;
    /** @var int The transaction version for sending to an alias. */
    public const VERSION_ALIAS_SEND = 2;
    /** @var int The transaction version for setting an alias. */
    public const VERSION_ALIAS_SET = 3;
    /** @var int The transaction version for creating a masternode. */
    public const VERSION_MASTERNODE_CREATE = 100;
    /** @var int The transaction version for pausing a masternode. */
    public const VERSION_MASTERNODE_PAUSE = 101;
    /** @var int The transaction version for resuming a masternode. */
    public const VERSION_MASTERNODE_RESUME = 102;
    /** @var int The transaction version for releasing a masternode. */
    public const VERSION_MASTERNODE_RELEASE = 103;
    /** @var int The default value for masternode commands. */
    public const VALUE_MASTERNODE_COMMAND = 0.00000001;
    /** @var int The default fee for masternode commands. */
    public const FEE_MASTERNODE_COMMAND = 0.00000001;
    /** @var int The value for masternode creation. */
    public const VALUE_MASTERNODE_CREATE = 100000;
    /** @var int The value for masternode creation. */
    public const FEE_MASTERNODE_CREATE = 10;
    /** @var int The value for alias creation. */
    public const VALUE_ALIAS_SET = 0.00000001;
    /** @var int The fee for alias creation. */
    public const FEE_ALIAS_SET = 10;

    /**
     * The value to send in the transaction.
     * @var float
     */
    public $val;
    /**
     * The fee for the transaction.
     * @var float
     */
    public $fee;
    /**
     * The destination address.
     * @var string
     */
    public $dst;
    /**
     * The sender's public key.
     * @var string
     */
    public $public_key;
    /**
     * The transaction signature.
     * It's recommended that the transaction is signed to avoid sending your private key to the node.
     * @var string
     */
    public $signature;
    /**
     * The sender's private key. Only required if no signature is provided.
     * @var string
     */
    public $private_key;
    /**
     * The transaction date in unix timestamp format.
     * This is required when the transaction is pre-signed.
     * @var int
     * @see https://epochconverter.com
     */
    public $date;
    /**
     * A message to be included with the transaction. Maximum 128 chars.
     * @var string
     */
    public $message;
    /**
     * The version of the transaction.
     * @var int
     */
    public $version = self::VERSION_STANDARD;

    /**
     * Retrieve a pre-populated Transaction instance for sending to an alias.
     *
     * @api
     * @param string $alias
     * @param float  $value
     * @param string $message
     * @return self
     */
    public static function makeAliasSendInstance(string $alias, float $value, string $message = ''): self
    {
        $transaction = new self();

        $transaction->setVersion(self::VERSION_ALIAS_SEND);
        $transaction->setDestinationAddress($alias);
        $transaction->setValue($value);
        $transaction->setMessage($message);

        return $transaction;
    }

    /**
     * Retrieve a pre-populated Transaction instance for setting an alias.
     *
     * @api
     * @param string $address
     * @param string $alias
     * @return self
     */
    public static function makeAliasSetInstance(string $address, string $alias): self
    {
        $transaction = new self();

        $transaction->setVersion(self::VERSION_ALIAS_SET);
        $transaction->setDestinationAddress($address);
        $transaction->setValue(self::VALUE_ALIAS_SET);
        $transaction->setFee(self::FEE_ALIAS_SET);
        $transaction->setMessage($alias);

        return $transaction;
    }

    /**
     * Retrieve a pre-populated Transaction instance for creating a masternode.
     *
     * @api
     * @param string $ipAddress
     * @param string $address
     * @return self
     */
    public static function makeMasternodeCreateInstance(string $ipAddress, string $address): self
    {
        $transaction = new self();

        $transaction->setVersion(self::VERSION_MASTERNODE_CREATE);
        $transaction->setDestinationAddress($address);
        $transaction->setValue(self::VALUE_MASTERNODE_CREATE);
        $transaction->setFee(self::FEE_MASTERNODE_CREATE);
        $transaction->setMessage($ipAddress);

        return $transaction;
    }

    /**
     * Retrieve a pre-populated Transaction instance for pausing a masternode.
     *
     * @api
     * @param string $address
     * @return self
     */
    public static function makeMasternodePauseInstance(string $address): self
    {
        $transaction = new self();

        $transaction->setVersion(self::VERSION_MASTERNODE_PAUSE);
        return self::setMasternodeCommandDefaults($address, $transaction);
    }

    /**
     * Retrieve a pre-populated Transaction instance for resuming a masternode.
     *
     * @api
     * @param string $address
     * @return self
     */
    public static function makeMasternodeResumeInstance(string $address): self
    {
        $transaction = new self();

        $transaction->setVersion(self::VERSION_MASTERNODE_RESUME);
        return self::setMasternodeCommandDefaults($address, $transaction);
    }

    /**
     * Retrieve a pre-populated Transaction instance for releasing a masternode.
     *
     * @api
     * @param string $address
     * @return self
     */
    public static function makeMasternodeReleaseInstance(string $address): self
    {
        $transaction = new self();

        $transaction->setVersion(self::VERSION_MASTERNODE_RELEASE);
        return self::setMasternodeCommandDefaults($address, $transaction);
    }

    /**
     * @param float $value
     * @return $this
     */
    public function setValue(float $value): self
    {
        $this->val = $value;

        return $this;
    }

    /**
     * @param float $fee
     * @return $this
     */
    public function setFee(float $fee): self
    {
        $this->fee = $fee;

        return $this;
    }

    /**
     * @param string $destinationAddress
     * @return $this
     */
    public function setDestinationAddress(string $destinationAddress): self
    {
        $this->dst = $destinationAddress;

        return $this;
    }

    /**
     * @param string $publicKey
     * @return $this
     */
    public function setPublicKey(string $publicKey): self
    {
        $this->public_key = $publicKey;

        return $this;
    }

    /**
     * @param string $signature
     * @return $this
     */
    public function setSignature(string $signature): self
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * @param string $privateKey
     * @return $this
     */
    public function setPrivateKey(string $privateKey): self
    {
        $this->private_key = $privateKey;

        return $this;
    }

    /**
     * @param int $date
     * @return $this
     */
    public function setDate(int $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param int $version
     * @return $this
     */
    public function setVersion(int $version): self
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Set the default fee and value for masternode commands.
     *
     * @internal
     * @param string $address
     * @param self   $transaction
     * @return self
     */
    private static function setMasternodeCommandDefaults(string $address, Transaction $transaction): self
    {
        $transaction->setDestinationAddress($address);
        $transaction->setValue(self::VALUE_MASTERNODE_COMMAND);
        $transaction->setFee(self::FEE_MASTERNODE_COMMAND);

        return $transaction;
    }
}
