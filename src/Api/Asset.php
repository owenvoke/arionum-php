<?php

declare(strict_types=1);

namespace OwenVoke\Arionum\Api;

class Asset extends AbstractApi
{
    public function all(): array
    {
        return $this->get(self::API_PATH, [
            'q' => 'assets',
        ]);
    }

    public function show(string $id): array
    {
        return $this->get(self::API_PATH, [
            'q' => 'assets',
            'asset' => $id,
        ]);
    }

    public function balance(string $address): float
    {
        return (float) $this->get(self::API_PATH, [
            'q' => 'assetBalance',
            'account' => $address,
        ]);
    }

    public function orders(string $address, string|null $id = null): array
    {
        return $this->get(self::API_PATH, [
            'q' => 'asset-orders',
            'account' => $address,
            'asset' => $id,
        ]);
    }
}
