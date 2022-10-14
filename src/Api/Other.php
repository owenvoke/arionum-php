<?php

declare(strict_types=1);

namespace OwenVoke\Arionum\Api;

class Other extends AbstractApi
{
    public function base58(string $data): string
    {
        return $this->get(self::API_PATH, [
            'q' => 'base58',
            'data' => $data,
        ]);
    }

    public function randomNumber(int $height, int $minimum, int $maximum, ?string $seed = null): int
    {
        return (int) $this->get(self::API_PATH, [
            'q' => 'randomNumber',
            'height' => $height,
            'min' => $minimum,
            'max' => $maximum,
            'seed' => $seed,
        ]);
    }

    public function checkSignature(string $signature, string $data, string $publicKey): bool
    {
        return ((string) $this->get(self::API_PATH, [
            'q' => 'checkSignature',
            'signature' => $signature,
            'data' => $data,
            'public_key' => $publicKey,
        ])) === 'true';
    }
}
