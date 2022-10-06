<?php

declare(strict_types=1);

namespace OwenVoke\Arionum\Api;

class Other extends AbstractApi
{
    public function base58(string $data): array
    {
        return $this->get(self::API_PATH, [
            'q' => 'base58',
            'data' => $data,
        ]);
    }

    public function randomNumber(int $height, int $minimum, int $maximum, ?string $seed = null): array
    {
        return $this->get(self::API_PATH, [
            'q' => 'randomNumber',
            'height' => $height,
            'min' => $minimum,
            'max' => $maximum,
            'seed' => $seed,
        ]);
    }

    public function checkSignature(string $signature, string $data, string $publicKey): array
    {
        return $this->get(self::API_PATH, [
            'q' => 'checkSignature',
            'signature' => $signature,
            'data' => $data,
            'public_key' => $publicKey,
        ]);
    }
}
