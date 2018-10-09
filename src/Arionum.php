<?php

namespace pxgamer\Arionum;

use GuzzleHttp\Client;

/**
 * Class Arionum
 */
class Arionum
{
    /**
     * The request endpoint for API calls.
     */
    public const API_ENDPOINT = '/api.php';
    /**
     * The API status code for a successful response.
     */
    public const API_STATUS_OK = 'ok';

    /**
     * @var string
     */
    private $nodeAddress;
    /**
     * @var Client
     */
    private $client;

    /**
     * Arionum constructor.
     *
     * @param string $nodeAddress
     */
    public function __construct(string $nodeAddress = null)
    {
        $this->nodeAddress = $nodeAddress;
    }

    /**
     * Retrieve the address for a specified public key.
     *
     * @param string $publicKey
     * @return string
     * @throws ApiException
     */
    public function getAddress(string $publicKey): string
    {
        return $this->getJson([
            'q'          => 'getAddress',
            'public_key' => $publicKey,
        ]);
    }

    /**
     * Convert a string to Base58.
     *
     * @param string $data
     * @return string
     * @throws ApiException
     */
    public function getBase58(string $data): string
    {
        return $this->getJson([
            'q'    => 'base58',
            'data' => $data,
        ]);
    }

    /**
     * Retrieve the balance of a specified address.
     *
     * @param string $address
     * @return string
     * @throws ApiException
     */
    public function getBalance(string $address): string
    {
        return $this->getJson([
            'q'       => 'getBalance',
            'account' => $address,
        ]);
    }

    /**
     * Retrieve the pending balance of a specified address (includes pending transactions).
     *
     * @param string $address
     * @return string
     * @throws ApiException
     */
    public function getPendingBalance(string $address): string
    {
        return $this->getJson([
            'q'       => 'getPendingBalance',
            'account' => $address,
        ]);
    }

    /**
     * Retrieve the transactions of a specified address.
     *
     * @param string $address
     * @return \stdClass[]
     * @throws ApiException
     */
    public function getTransactions(string $address): array
    {
        return $this->getJson([
            'q'       => 'getTransactions',
            'account' => $address,
        ]);
    }

    /**
     * Retrieve a specified transaction by its id.
     *
     * @param string $transactionId
     * @return \stdClass
     * @throws ApiException
     */
    public function getTransaction(string $transactionId): \stdClass
    {
        return $this->getJson([
            'q'           => 'getTransaction',
            'transaction' => $transactionId,
        ]);
    }

    /**
     * Retrieve the public key of a specified address.
     *
     * @param string $address
     * @return string
     * @throws ApiException
     */
    public function getPublicKey(string $address): string
    {
        return $this->getJson([
            'q'       => 'getPublicKey',
            'account' => $address,
        ]);
    }

    /**
     * Generate a new public/private key pair and return these with the address.
     *
     * @return \stdClass
     * @throws ApiException
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
     * @throws ApiException
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
     * @throws ApiException
     */
    public function getBlock(int $height): \stdClass
    {
        return $this->getJson([
            'q'      => 'getBlock',
            'height' => $height,
        ]);
    }

    /**
     * Retrieve the transactions of a specified block.
     *
     * @param string $blockId
     * @return \stdClass[]
     * @throws ApiException
     */
    public function getBlockTransactions(string $blockId): array
    {
        return $this->getJson([
            'q'     => 'getBlockTransactions',
            'block' => $blockId,
        ]);
    }

    /**
     * Retrieve the version of the node.
     *
     * @return string
     * @throws ApiException
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
     * @throws ApiException
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
     * @throws ApiException
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
     * @param int|null    $maximum
     * @param string|null $seed
     * @return int
     * @throws ApiException
     */
    public function getRandomNumber(int $height, int $minimum, int $maximum, string $seed = null): int
    {
        return $this->getJson([
            'q'      => 'randomNumber',
            'height' => $height,
            'min'    => $minimum,
            'max'    => $maximum,
            'seed'   => $seed,
        ]);
    }

    /**
     * Retrieve a list of registered masternodes on the network.
     *
     * @return array
     * @throws ApiException
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
     * @throws ApiException
     */
    public function getAlias(string $address): string
    {
        return $this->getJson([
            'q'       => 'getAlias',
            'account' => $address,
        ]);
    }

    /**
     * @return string
     */
    public function getNodeAddress(): string
    {
        return $this->nodeAddress;
    }

    /**
     * @param string $nodeAddress
     */
    public function setNodeAddress(string $nodeAddress): void
    {
        $this->nodeAddress = $nodeAddress;
    }

    /**
     * @return Client
     */
    private function getClient(): Client
    {
        if (!$this->client instanceof Client) {
            $this->client = new Client([
                'base_uri' => $this->nodeAddress,
            ]);
        }

        return $this->client;
    }

    /**
     * @param array $query
     * @return mixed
     * @throws ApiException
     */
    private function getJson(array $query)
    {
        return $this->decodeResponse(
            $this->getClient()
                ->get($this->getNodeAddress().self::API_ENDPOINT, ['query' => $query])
                ->getBody()
                ->getContents()
        );
    }

    /**
     * @param string $json
     * @return mixed
     * @throws ApiException
     */
    private function decodeResponse(string $json)
    {
        $data = \GuzzleHttp\json_decode($json);

        if ($data->status === self::API_STATUS_OK) {
            return $data->data;
        }

        throw new ApiException($data->data);
    }
}
