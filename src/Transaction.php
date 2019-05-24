<?php

declare(strict_types=1);

namespace pxgamer\Arionum;

use pxgamer\Arionum\Transaction\Version;

final class Transaction
{
    /**
     * @deprecated
     *
     * @see Version::STANDARD
     *
     * The transaction version for sending to an address.
     */
    public const VERSION_STANDARD = Version::STANDARD;
    /**
     * @deprecated
     *
     * @see Version::ALIAS_SEND
     *
     * The transaction version for sending to an alias.
     */
    public const VERSION_ALIAS_SEND = Version::ALIAS_SEND;
    /**
     * @deprecated
     *
     * @see Version::ALIAS_SET
     *
     * The transaction version for setting an alias.
     */
    public const VERSION_ALIAS_SET = Version::ALIAS_SET;
    /**
     * @deprecated
     *
     * @see Version::MASTERNODE_CREATE
     *
     * The transaction version for creating a masternode.
     */
    public const VERSION_MASTERNODE_CREATE = Version::MASTERNODE_CREATE;
    /**
     * @deprecated
     *
     * @see Version::MASTERNODE_PAUSE
     *
     * The transaction version for pausing a masternode.
     */
    public const VERSION_MASTERNODE_PAUSE = Version::MASTERNODE_PAUSE;
    /**
     * @deprecated
     *
     * @see Version::MASTERNODE_RESUME
     *
     * The transaction version for resuming a masternode.
     */
    public const VERSION_MASTERNODE_RESUME = Version::MASTERNODE_RESUME;
    /**
     * @deprecated
     *
     * @see Version::MASTERNODE_RELEASE
     *
     * The transaction version for releasing a masternode.
     */
    public const VERSION_MASTERNODE_RELEASE = Version::MASTERNODE_RELEASE;

    /** The default value for masternode commands. */
    public const VALUE_MASTERNODE_COMMAND = 0.00000001;
    /** The default fee for masternode commands. */
    public const FEE_MASTERNODE_COMMAND = 0.00000001;
    /** The value for masternode creation. */
    public const VALUE_MASTERNODE_CREATE = 100000;
    /** The value for masternode creation. */
    public const FEE_MASTERNODE_CREATE = 10;
    /** The value for alias creation. */
    public const VALUE_ALIAS_SET = 0.00000001;
    /** The fee for alias creation. */
    public const FEE_ALIAS_SET = 10;

    /**
     * The value to send in the transaction.
     *
     * @var float
     */
    private $val;
    /**
     * The fee for the transaction.
     *
     * @var float
     */
    private $fee;
    /**
     * The destination address.
     *
     * @var string
     */
    private $dst;
    /**
     * The sender's public key.
     *
     * @var string
     */
    private $public_key;
    /**
     * The transaction signature.
     * It's recommended that the transaction is signed to avoid sending your private key to the node.
     *
     * @var string
     */
    private $signature;
    /**
     * The sender's private key. Only required if no signature is provided.
     *
     * @var string
     */
    private $private_key;
    /**
     * The transaction date in unix timestamp format.
     * This is required when the transaction is pre-signed.
     *
     * @see https://epochconverter.com
     *
     * @var int
     */
    private $date;
    /**
     * A message to be included with the transaction. Maximum 128 chars.
     *
     * @var string
     */
    private $message;
    /**
     * The version of the transaction.
     *
     * @var int
     */
    private $version = Version::STANDARD;

    /**
     * Retrieve a pre-populated Transaction instance for sending to an alias.
     *
     * @param  string  $alias
     * @param  float  $value
     * @param  string  $message
     *
     * @return self
     */
    public static function makeAliasSendInstance(string $alias, float $value, string $message = ''): self
    {
        $transaction = new self();

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
     * @return self
     */
    public static function makeAliasSetInstance(string $address, string $alias): self
    {
        $transaction = new self();

        $transaction->setVersion(Version::ALIAS_SET);
        $transaction->setDestinationAddress($address);
        $transaction->setValue(self::VALUE_ALIAS_SET);
        $transaction->setFee(self::FEE_ALIAS_SET);
        $transaction->setMessage($alias);

        return $transaction;
    }

    /**
     * Retrieve a pre-populated Transaction instance for creating a masternode.
     *
     * @param  string  $ipAddress
     * @param  string  $address
     *
     * @return self
     */
    public static function makeMasternodeCreateInstance(string $ipAddress, string $address): self
    {
        $transaction = new self();

        $transaction->setVersion(Version::MASTERNODE_CREATE);
        $transaction->setDestinationAddress($address);
        $transaction->setValue(self::VALUE_MASTERNODE_CREATE);
        $transaction->setFee(self::FEE_MASTERNODE_CREATE);
        $transaction->setMessage($ipAddress);

        return $transaction;
    }

    /**
     * Retrieve a pre-populated Transaction instance for pausing a masternode.
     *
     * @param  string  $address
     *
     * @return self
     */
    public static function makeMasternodePauseInstance(string $address): self
    {
        $transaction = new self();

        $transaction->setVersion(Version::MASTERNODE_PAUSE);

        return self::setMasternodeCommandDefaults($address, $transaction);
    }

    /**
     * Retrieve a pre-populated Transaction instance for resuming a masternode.
     *
     * @param  string  $address
     *
     * @return self
     */
    public static function makeMasternodeResumeInstance(string $address): self
    {
        $transaction = new self();

        $transaction->setVersion(Version::MASTERNODE_RESUME);

        return self::setMasternodeCommandDefaults($address, $transaction);
    }

    /**
     * Retrieve a pre-populated Transaction instance for releasing a masternode.
     *
     * @param  string  $address
     *
     * @return self
     */
    public static function makeMasternodeReleaseInstance(string $address): self
    {
        $transaction = new self();

        $transaction->setVersion(Version::MASTERNODE_RELEASE);

        return self::setMasternodeCommandDefaults($address, $transaction);
    }

    /**
     * @param  float  $value
     *
     * @return $this
     */
    public function setValue(float $value): self
    {
        $this->val = $value;

        return $this;
    }

    /**
     * @param  float  $fee
     *
     * @return $this
     */
    public function setFee(float $fee): self
    {
        $this->fee = $fee;

        return $this;
    }

    /**
     * @param  string  $destinationAddress
     *
     * @return $this
     */
    public function setDestinationAddress(string $destinationAddress): self
    {
        $this->dst = $destinationAddress;

        return $this;
    }

    /**
     * @param  string  $publicKey
     *
     * @return $this
     */
    public function setPublicKey(string $publicKey): self
    {
        $this->public_key = $publicKey;

        return $this;
    }

    /**
     * @param  string  $signature
     *
     * @return $this
     */
    public function setSignature(string $signature): self
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * @param  string  $privateKey
     *
     * @return $this
     */
    public function setPrivateKey(string $privateKey): self
    {
        $this->private_key = $privateKey;

        return $this;
    }

    /**
     * @param  int  $date
     *
     * @return $this
     */
    public function setDate(int $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @param  string  $message
     *
     * @return $this
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param  int  $version
     *
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
     * @param  string  $address
     * @param  self  $transaction
     *
     * @return self
     */
    private static function setMasternodeCommandDefaults(string $address, self $transaction): self
    {
        $transaction->setDestinationAddress($address);
        $transaction->setValue(self::VALUE_MASTERNODE_COMMAND);
        $transaction->setFee(self::FEE_MASTERNODE_COMMAND);

        return $transaction;
    }

    public function getValue(): float
    {
        return $this->val;
    }

    public function getFee(): float
    {
        return $this->fee;
    }

    public function getDestinationAddress(): string
    {
        return $this->dst;
    }

    public function getPublicKey(): string
    {
        return $this->public_key;
    }

    public function getSignature(): ?string
    {
        return $this->signature;
    }

    public function getPrivateKey(): ?string
    {
        return $this->private_key;
    }

    public function getDate(): int
    {
        return $this->date;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getVersion(): int
    {
        return $this->version;
    }

    public function toArray(): array
    {
        return [
            'date' => $this->getDate(),
            'dst' => $this->getDestinationAddress(),
            'fee' => $this->getFee(),
            'message' => $this->getMessage(),
            'private_key' => $this->getPrivateKey(),
            'public_key' => $this->getPublicKey(),
            'signature' => $this->getSignature(),
            'val' => $this->getValue(),
            'version' => $this->getVersion(),
        ];
    }
}
