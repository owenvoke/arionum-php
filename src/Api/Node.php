<?php

declare(strict_types=1);

namespace OwenVoke\Arionum\Api;

class Node extends AbstractApi
{
    public function info(): array
    {
        return $this->get(self::API_PATH, [
            'q' => 'node-info',
        ]);
    }

    public function version(): string
    {
        return $this->get(self::API_PATH, [
            'q' => 'version',
        ]);
    }

    public function sanity(): string
    {
        return $this->get(self::API_PATH, [
            'q' => 'sanity',
        ]);
    }

    public function masternodes(): string
    {
        return $this->get(self::API_PATH, [
            'q' => 'masternodes',
        ]);
    }
}
