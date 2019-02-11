<?php

namespace pxgamer\Arionum\Api;

use pxgamer\Arionum\Exception\HttpException;
use pxgamer\Arionum\Transaction;
use function GuzzleHttp\json_decode;

class Node extends AbstractApi
{
    public const API_STATUS_OK = 'ok';

    /**
     * Retrieve the address for a specified public key.
     *
     * @param string $publicKey
     * @return string
     * @throws HttpException
     * @api
     */
    public function getAddress(string $publicKey): string
    {
        return $this->getJson([
            'q' => 'getAddress',
            'public_key' => $publicKey,
        ]);
    }

    /**
     * Convert a string to Base58.
     *
     * @param string $data
     * @return string
     * @throws HttpException
     * @api
     */
    public function getBase58(string $data): string
    {
        return $this->getJson([
            'q' => 'base58',
            'data' => $data,
        ]);
    }

    /**
     * Retrieve the balance of a specified address.
     *
     * @param string $address
     * @return string
     * @throws HttpException
     * @api
     */
    public function getBalance(string $address): string
    {
        return $this->getJson([
            'q' => 'getBalance',
            'account' => $address,
        ]);
    }

    /**
     * Retrieve the balance of a specified alias.
     *
     * @param string $alias
     * @return string
     * @throws HttpException
     * @api
     */
    public function getBalanceByAlias(string $alias): string
    {
        return $this->getJson([
            'q' => 'getBalance',
            'alias' => $alias,
        ]);
    }

    /**
     * Retrieve the balance of a specified public key.
     *
     * @param string $publicKey
     * @return string
     * @throws HttpException
     * @api
     */
    public function getBalanceByPublicKey(string $publicKey): string
    {
        return $this->getJson([
            'q' => 'getBalance',
            'public_key' => $publicKey,
        ]);
    }

    /**
     * Retrieve the pending balance of a specified address (includes pending transactions).
     *
     * @param string $address
     * @return string
     * @throws HttpException
     * @api
     */
    public function getPendingBalance(string $address): string
    {
        return $this->getJson([
            'q' => 'getPendingBalance',
            'account' => $address,
        ]);
    }

    /**
     * Retrieve the transactions of a specified address.
     *
     * @param string $address
     * @param int    $limit
     * @return \stdClass[]
     * @throws HttpException
     * @api
     */
    public function getTransactions(string $address, int $limit = 100): array
    {
        return $this->getJson([
            'q' => 'getTransactions',
            'account' => $address,
            'limit' => $limit,
        ]);
    }

    /**
     * Retrieve the transactions of a specified public key.
     *
     * @param string $publicKey
     * @param int    $limit
     * @return \stdClass[]
     * @throws HttpException
     * @api
     */
    public function getTransactionsByPublicKey(string $publicKey, int $limit = 100): array
    {
        return $this->getJson([
            'q' => 'getTransactions',
            'public_key' => $publicKey,
            'limit' => $limit,
        ]);
    }

    /**
     * Retrieve a specified transaction by its id.
     *
     * @param string $transactionId
     * @return \stdClass
     * @throws HttpException
     * @api
     */
    public function getTransaction(string $transactionId): \stdClass
    {
        return $this->getJson([
            'q' => 'getTransaction',
            'transaction' => $transactionId,
        ]);
    }

    /**
     * Retrieve the public key of a specified address.
     *
     * @param string $address
     * @return string
     * @throws HttpException
     * @api
     */
    public function getPublicKey(string $address): string
    {
        return $this->getJson([
            'q' => 'getPublicKey',
            'account' => $address,
        ]);
    }

    /**
     * Generate a new public/private key pair and return these with the address.
     *
     * @return \stdClass
     * @throws HttpException
     * @api
     */
    public function generateAccount(): \stdClass
    {
        return $this->getJson([
            'q' => 'generateAccount',
        ]);
    }

    /**
     * Retrieve the current block as an object.
     *
     * @return \stdClass
     * @throws HttpException
     * @api
     */
    public function getCurrentBlock(): \stdClass
    {
        return $this->getJson([
            'q' => 'currentBlock',
        ]);
    }

    /**
     * Retrieve a block by its height.
     *
     * @param int $height
     * @return \stdClass
     * @throws HttpException
     * @api
     */
    public function getBlock(int $height): \stdClass
    {
        return $this->getJson([
            'q' => 'getBlock',
            'height' => $height,
        ]);
    }

    /**
     * Retrieve the transactions of a specified block.
     *
     * @param string $blockId
     * @return \stdClass[]
     * @throws HttpException
     * @api
     */
    public function getBlockTransactions(string $blockId): array
    {
        return $this->getJson([
            'q' => 'getBlockTransactions',
            'block' => $blockId,
        ]);
    }

    /**
     * Retrieve the version of the node.
     *
     * @return string
     * @throws HttpException
     * @api
     */
    public function getNodeVersion(): string
    {
        return $this->getJson([
            'q' => 'version',
        ]);
    }

    /**
     * Send a transaction.
     *
     * @param Transaction $transaction
     * @return string
     * @throws HttpException
     * @api
     */
    public function sendTransaction(Transaction $transaction): string
    {
        $data = array_merge((array)$transaction, [
            'q' => 'send',
        ]);

        return $this->getJson($data);
    }

    /**
     * Retrieve the number of transactions in the mempool.
     *
     * @return int
     * @throws HttpException
     * @api
     */
    public function getMempoolSize(): int
    {
        return $this->getJson([
            'q' => 'mempoolSize',
        ]);
    }

    /**
     * Retrieve a random number based on a specified block.
     *
     * @param int         $height
     * @param int         $minimum
     * @param int         $maximum
     * @param string|null $seed
     * @return int
     * @throws HttpException
     * @api
     */
    public function getRandomNumber(int $height, int $minimum, int $maximum, string $seed = null): int
    {
        return $this->getJson([
            'q' => 'randomNumber',
            'height' => $height,
            'min' => $minimum,
            'max' => $maximum,
            'seed' => $seed,
        ]);
    }

    /**
     * Check that a signature is valid against a public key.
     *
     * @param string $signature
     * @param string $data
     * @param string $publicKey
     * @return bool
     * @throws HttpException
     * @api
     */
    public function checkSignature(string $signature, string $data, string $publicKey): bool
    {
        return $this->getJson([
            'q' => 'checkSignature',
            'signature' => $signature,
            'data' => $data,
            'public_key' => $publicKey,
        ]);
    }

    /**
     * Retrieve a list of registered masternodes on the network.
     *
     * @return array
     * @throws HttpException
     * @api
     */
    public function getMasternodes(): array
    {
        return $this->getJson([
            'q' => 'masternodes',
        ])->masternodes;
    }

    /**
     * Retrieve the alias for an account by it's address.
     *
     * @param string $address
     * @return string
     * @throws HttpException
     * @api
     */
    public function getAlias(string $address): string
    {
        return $this->getJson([
            'q' => 'getAlias',
            'account' => $address,
        ]);
    }

    /**
     * Retrieve details about the nodes sanity process.
     *
     * @return \stdClass
     * @throws HttpException
     * @api
     */
    public function getSanityDetails(): \stdClass
    {
        return $this->getJson([
            'q' => 'sanity',
        ]);
    }

    /**
     * Retrieve details about the node.
     *
     * @return \stdClass
     * @throws HttpException
     * @api
     */
    public function getNodeInfo(): \stdClass
    {
        return $this->getJson([
            'q' => 'node-info',
        ]);
    }

    /**
     * Check that an address is valid.
     * Optionally validate it against the corresponding public key.
     *
     * @param string      $address
     * @param string|null $publicKey An optional corresponding public key.
     * @return bool
     * @throws HttpException
     * @api
     */
    public function checkAddress(string $address, ?string $publicKey = null): bool
    {
        return $this->getJson([
            'q' => 'checkAddress',
            'account' => $address,
            'public_key' => $publicKey,
        ]);
    }

    /**
     * @param array $query
     * @return mixed
     * @throws HttpException
     * @internal
     */
    private function getJson(array $query)
    {
        $data = json_decode($this->adapter->get('/api.php?'.http_build_query($query)));

        if ($data->status === self::API_STATUS_OK) {
            return $data->data;
        }

        throw new HttpException($data->data ?? 'An unknown API error occurred.');
    }
}
