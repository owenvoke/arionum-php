<?php

declare(strict_types=1);

namespace OwenVoke\Arionum\Api;

class Account extends AbstractApi
{
    public function address(string $publicKey): array
    {
        return $this->get(self::API_PATH, [
            'q' => 'getAddress',
            'public_key' => $publicKey,
        ]);
    }

    public function alias(string $address): array
    {
        return $this->get(self::API_PATH, [
            'q' => 'getAlias',
            'account' => $address,
        ]);
    }

    public function publicKey(string $address): array
    {
        return $this->get(self::API_PATH, [
            'q' => 'getPublicKey',
            'account' => $address,
        ]);
    }

    public function generate(): array
    {
        return $this->get(self::API_PATH, [
            'q' => 'generateAccount',
        ]);
    }

    public function balance(string $address): array
    {
        return $this->get(self::API_PATH, [
            'q' => 'getBalance',
            'account' => $address,
        ]);
    }

    public function balanceByAlias(string $alias): array
    {
        return $this->get(self::API_PATH, [
            'q' => 'getBalance',
            'alias' => $alias,
        ]);
    }

    public function balanceByPublicKey(string $publicKey): array
    {
        return $this->get(self::API_PATH, [
            'q' => 'getBalance',
            'public_key' => $publicKey,
        ]);
    }

    public function pendingBalance(string $address): array
    {
        return $this->get(self::API_PATH, [
            'q' => 'getPendingBalance',
            'account' => $address,
        ]);
    }

    public function checkAddress(string $address, ?string $publicKey = null): array
    {
        return $this->get(self::API_PATH, [
            'q' => 'checkAddress',
            'account' => $address,
            'public_key' => $publicKey,
        ]);
    }
}
