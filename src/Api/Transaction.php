<?php

declare(strict_types=1);

namespace OwenVoke\Arionum\Api;

class Transaction extends AbstractApi
{
    public function transactions(string $address, int $limit = 100): array
    {
        return $this->get(self::API_PATH, [
            'q' => 'getTransactions',
            'account' => $address,
            'limit' => $limit,
        ]);
    }

    public function transactionsByPublicKey(string $publicKey, int $limit = 100): array
    {
        return $this->get(self::API_PATH, [
            'q' => 'getTransactions',
            'public_key' => $publicKey,
            'limit' => $limit,
        ]);
    }

    public function transaction(string $id): array
    {
        return $this->get(self::API_PATH, [
            'q' => 'getTransaction',
            'transaction' => $id,
        ]);
    }

    public function send(array $transaction): array
    {
        return $this->get(self::API_PATH, array_merge($transaction, [
            'q' => 'send',
        ]));
    }

    public function mempoolSize(): array
    {
        return $this->get(self::API_PATH, [
            'q' => 'mempoolSize',
        ]);
    }
}
