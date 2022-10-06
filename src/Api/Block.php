<?php

declare(strict_types=1);

namespace OwenVoke\Arionum\Api;

class Block extends AbstractApi
{
    public function currentBlock(): array
    {
        return $this->get(self::API_PATH, [
            'q' => 'currentBlock',
        ]);
    }

    public function block(int $height): array
    {
        return $this->get(self::API_PATH, [
            'q' => 'getBlock',
            'height' => $height,
        ]);
    }

    public function transactions(string $id): array
    {
        return $this->get(self::API_PATH, [
            'q' => 'getBlockTransactions',
            'block' => $id,
        ]);
    }
}
