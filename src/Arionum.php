<?php

declare(strict_types=1);

namespace pxgamer\Arionum;

use stdClass;
use GuzzleHttp\Client;
use pxgamer\Arionum\Models\Account;
use function GuzzleHttp\json_decode;
use pxgamer\Arionum\Models\Transaction;
use pxgamer\Arionum\Exceptions\GenericApiException;
use pxgamer\Arionum\Exceptions\GenericLocalException;

final class Arionum
{
    /** The request endpoint for API calls. */
    public const API_ENDPOINT = '/api.php';
    /** The API status code for a successful response. */
    public const API_STATUS_OK = 'ok';

    /** @var string */
    private $nodeAddress;
    /** @var Client */
    private $client;

    /**
     * @param  string  $nodeAddress
     * @param  Client|null  $client
     */
    public function __construct(string $nodeAddress, ?Client $client = null)
    {
        $this->nodeAddress = $nodeAddress;
        $this->client = $client ?? new Client();
    }

    /**
     * Retrieve the address for a specified public key.
     *
     * @param  string  $publicKey
     *
     * @return string
     *
     * @throws GenericApiException
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
     * @param  string  $data
     *
     * @return string
     *
     * @throws GenericApiException
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
     * @param  string  $address
     *
     * @return string
     *
     * @throws GenericApiException
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
     * @param  string  $alias
     *
     * @return string
     *
     * @throws GenericApiException
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
     * @param  string  $publicKey
     *
     * @return string
     *
     * @throws GenericApiException
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
     * @param  string  $address
     *
     * @return string
     *
     * @throws GenericApiException
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
     * @param  string  $address
     * @param  int  $limit
     *
     * @return array<stdClass>
     *
     * @throws GenericApiException
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
     * @param  string  $publicKey
     * @param  int  $limit
     *
     * @return array<stdClass>
     *
     * @throws GenericApiException
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
     * @param  string  $transactionId
     *
     * @return stdClass
     *
     * @throws GenericApiException
     */
    public function getTransaction(string $transactionId): stdClass
    {
        return $this->getJson([
            'q' => 'getTransaction',
            'transaction' => $transactionId,
        ]);
    }

    /**
     * Retrieve the public key of a specified address.
     *
     * @param  string  $address
     *
     * @return string
     *
     * @throws GenericApiException
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
     * @return Account
     *
     * @throws GenericApiException
     */
    public function generateAccount(): Account
    {
        $generatedAccount = $this->getJson([
            'q' => 'generateAccount',
        ]);

        return new Account($generatedAccount->public_key, $generatedAccount->private_key);
    }

    /**
     * Retrieve the current block as an object.
     *
     * @return stdClass
     *
     * @throws GenericApiException
     */
    public function getCurrentBlock(): stdClass
    {
        return $this->getJson([
            'q' => 'currentBlock',
        ]);
    }

    /**
     * Retrieve a block by its height.
     *
     * @param  int  $height
     *
     * @return stdClass
     *
     * @throws GenericApiException
     */
    public function getBlock(int $height): stdClass
    {
        return $this->getJson([
            'q' => 'getBlock',
            'height' => $height,
        ]);
    }

    /**
     * Retrieve the transactions of a specified block.
     *
     * @param  string  $blockId
     *
     * @return array<stdClass>
     *
     * @throws GenericApiException
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
     *
     * @throws GenericApiException
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
     * @param  Transaction  $transaction
     *
     * @return string
     *
     * @throws GenericApiException
     */
    public function sendTransaction(Transaction $transaction): string
    {
        $data = array_merge($transaction->toArray(), [
            'q' => 'send',
        ]);

        return $this->getJson($data);
    }

    /**
     * Retrieve the number of transactions in the mempool.
     *
     * @return int
     *
     * @throws GenericApiException
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
     * @param  int  $height
     * @param  int  $minimum
     * @param  int  $maximum
     * @param  string|null  $seed
     *
     * @return int
     *
     * @throws GenericApiException
     */
    public function getRandomNumber(int $height, int $minimum, int $maximum, ?string $seed = null): int
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
     * @param  string  $signature
     * @param  string  $data
     * @param  string  $publicKey
     *
     * @return bool
     *
     * @throws GenericApiException
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
     * @return array<stdClass>
     *
     * @throws GenericApiException
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
     * @param  string  $address
     *
     * @return string
     *
     * @throws GenericApiException
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
     * @return stdClass
     *
     * @throws GenericApiException
     */
    public function getSanityDetails(): stdClass
    {
        return $this->getJson([
            'q' => 'sanity',
        ]);
    }

    /**
     * Retrieve details about the node.
     *
     * @return stdClass
     *
     * @throws GenericApiException
     */
    public function getNodeInfo(): stdClass
    {
        return $this->getJson([
            'q' => 'node-info',
        ]);
    }

    /**
     * Check that an address is valid.
     * Optionally validate it against the corresponding public key.
     *
     * @param  string  $address
     * @param  string|null  $publicKey  An optional corresponding public key.
     *
     * @return bool
     *
     * @throws GenericApiException
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
     * Retrieve the asset balance for a specific address.
     *
     * @param  string  $address
     *
     * @return array<stdClass>
     *
     * @throws GenericApiException
     */
    public function getAssetBalance(string $address): array
    {
        return $this->getJson([
            'q' => 'assetBalance',
            'account' => $address,
        ]);
    }

    /**
     * Retrieve the asset orders for a specific address.
     *
     * @param  string  $address
     * @param  string|null  $assetId
     *
     * @return array<stdClass>
     *
     * @throws GenericApiException
     */
    public function getAssetOrders(string $address, ?string $assetId = null): array
    {
        return $this->getJson([
            'q' => 'asset-orders',
            'account' => $address,
            'asset' => $assetId,
        ]);
    }

    /**
     * Retrieve a list of assets.
     *
     * @return array<stdClass>
     *
     * @throws GenericApiException
     */
    public function getAssets(): array
    {
        return $this->getJson([
            'q' => 'assets',
        ]);
    }

    /**
     * Retrieve a specific asset.
     *
     * @param  string  $assetId
     *
     * @return array<stdClass>
     *
     * @throws GenericApiException
     */
    public function getAsset(string $assetId): array
    {
        return $this->getJson([
            'q' => 'assets',
            'asset' => $assetId,
        ]);
    }

    /**
     * Generate a new public/private key pair and return these with the address.
     *
     * @return Account
     *
     * @throws GenericLocalException
     */
    public function generateLocalAccount(): Account
    {
        return Account::make();
    }

    public function getNodeAddress(): string
    {
        return $this->nodeAddress;
    }

    /**
     * @param  array<string, bool|float|int|string|null>  $query
     *
     * @return mixed
     *
     * @throws GenericApiException
     */
    private function getJson(array $query)
    {
        return $this->decodeResponse(
            $this->client
                ->get($this->getNodeAddress().self::API_ENDPOINT, ['query' => $query])
                ->getBody()
                ->getContents()
        );
    }

    /**
     * @param  string  $json
     *
     * @return mixed
     *
     * @throws GenericApiException
     */
    private function decodeResponse(string $json)
    {
        $data = json_decode($json, false);

        if ($data->status === self::API_STATUS_OK) {
            return $data->data;
        }

        throw new GenericApiException($data->data ?? 'An unknown API error occurred.');
    }
}
