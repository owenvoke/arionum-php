<?php

declare(strict_types=1);

namespace OwenVoke\Arionum\Api;

class Account extends AbstractApi
{
    public function generate(): array
    {
        return $this->get(self::API_PATH, [
            'q' => 'generateAccount',
        ]);
    }

    public function address(string $publicKey): string
    {
        return $this->get(self::API_PATH, [
            'q' => 'getAddress',
            'public_key' => $publicKey,
        ]);
    }

    public function alias(string $address): string
    {
        return $this->get(self::API_PATH, [
            'q' => 'getAlias',
            'account' => $address,
        ]);
    }

    public function publicKey(string $address): string
    {
        return $this->get(self::API_PATH, [
            'q' => 'getPublicKey',
            'account' => $address,
        ]);
    }

    public function balance(string $address): float
    {
        return (float) $this->get(self::API_PATH, [
            'q' => 'getBalance',
            'account' => $address,
        ]);
    }

    public function balanceByAlias(string $alias): float
    {
        return (float) $this->get(self::API_PATH, [
            'q' => 'getBalance',
            'alias' => $alias,
        ]);
    }

    public function balanceForPublicKey(string $publicKey): float
    {
        return (float) $this->get(self::API_PATH, [
            'q' => 'getBalance',
            'public_key' => $publicKey,
        ]);
    }

    public function pendingBalance(string $address): float
    {
        return (float) $this->get(self::API_PATH, [
            'q' => 'getPendingBalance',
            'account' => $address,
        ]);
    }

    public function pendingBalanceForPublicKey(string $publicKey): float
    {
        return (float) $this->get(self::API_PATH, [
            'q' => 'getPendingBalance',
            'public_key' => $publicKey,
        ]);
    }

    public function checkAddress(string $address, ?string $publicKey = null): bool
    {
        return (bool) $this->get(self::API_PATH, [
            'q' => 'checkAddress',
            'account' => $address,
            'public_key' => $publicKey,
        ]);
    }
}
