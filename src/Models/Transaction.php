<?php

declare(strict_types=1);

namespace pxgamer\Arionum\Models;

use pxgamer\Arionum\Transaction\Version;

final class Transaction
{
    /* The default value for masternode commands */
    public const VALUE_MASTERNODE_COMMAND = 0.00000001;
    /* The default fee for masternode commands */
    public const FEE_MASTERNODE_COMMAND = 0.00000001;
    /* The value for masternode creation */
    public const VALUE_MASTERNODE_CREATE = 100000;
    /* The value for masternode creation */
    public const FEE_MASTERNODE_CREATE = 10;
    /* The value for alias creation */
    public const VALUE_ALIAS_SET = 0.00000001;
    /* The fee for alias creation */
    public const FEE_ALIAS_SET = 10;

    /** @var float The value to send in the transaction */
    private $value;
    /** @var float The fee for the transaction */
    private $fee;
    /** @var string The destination address */
    private $destinationAddress;
    /** @var string The sender's public key */
    private $publicKey;
    /** @var string The sender's private key. Only required if no signature is provided */
    private $privateKey;
    /** @var string A message to be included with the transaction. Maximum 128 chars */
    private $message;
    /** @var int The version of the transaction */
    private $version = Version::STANDARD;
    /**
     * The transaction signature
     * It's recommended that the transaction is signed to avoid sending your private key to the node.
     *
     * @var string
     */
    private $signature;
    /**
     * The transaction date in unix timestamp format
     * This is required when the transaction is pre-signed.
     *
     * @see https://epochconverter.com
     *
     * @var int
     */
    private $date;

    public function changeValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function changeFee(float $fee): self
    {
        $this->fee = $fee;

        return $this;
    }

    public function changeDestinationAddress(string $destinationAddress): self
    {
        $this->destinationAddress = $destinationAddress;

        return $this;
    }

    public function changePublicKey(string $publicKey): self
    {
        $this->publicKey = $publicKey;

        return $this;
    }

    public function changeSignature(string $signature): self
    {
        $this->signature = $signature;

        return $this;
    }

    public function changePrivateKey(string $privateKey): self
    {
        $this->privateKey = $privateKey;

        return $this;
    }

    public function changeDate(int $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function changeMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

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

    /** @return array<string, float|int|string|null> */
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
