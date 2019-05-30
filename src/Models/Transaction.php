<?php

declare(strict_types=1);

namespace pxgamer\Arionum\Models;

use pxgamer\Arionum\Transaction\Version;

final class Transaction
{
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
    private $value;
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
    private $destinationAddress;
    /**
     * The sender's public key.
     *
     * @var string
     */
    private $publicKey;
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
    private $privateKey;
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
     * @param  float  $value
     *
     * @return $this
     */
    public function changeValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @param  float  $fee
     *
     * @return $this
     */
    public function changeFee(float $fee): self
    {
        $this->fee = $fee;

        return $this;
    }

    /**
     * @param  string  $destinationAddress
     *
     * @return $this
     */
    public function changeDestinationAddress(string $destinationAddress): self
    {
        $this->destinationAddress = $destinationAddress;

        return $this;
    }

    /**
     * @param  string  $publicKey
     *
     * @return $this
     */
    public function changePublicKey(string $publicKey): self
    {
        $this->publicKey = $publicKey;

        return $this;
    }

    /**
     * @param  string  $signature
     *
     * @return $this
     */
    public function changeSignature(string $signature): self
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * @param  string  $privateKey
     *
     * @return $this
     */
    public function changePrivateKey(string $privateKey): self
    {
        $this->privateKey = $privateKey;

        return $this;
    }

    /**
     * @param  int  $date
     *
     * @return $this
     */
    public function changeDate(int $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @param  string  $message
     *
     * @return $this
     */
    public function changeMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param  int  $version
     *
     * @return $this
     */
    public function changeVersion(int $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getFee(): float
    {
        return $this->fee;
    }

    public function getDestinationAddress(): string
    {
        return $this->destinationAddress;
    }

    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    public function getSignature(): ?string
    {
        return $this->signature;
    }

    public function getPrivateKey(): ?string
    {
        return $this->privateKey;
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

    /** @return array<string, int|string> */
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
