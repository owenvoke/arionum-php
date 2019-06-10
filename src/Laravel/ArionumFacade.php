<?php

namespace pxgamer\Arionum\Laravel;

use stdClass;
use pxgamer\Arionum\Arionum;
use Illuminate\Support\Facades\Facade;
use pxgamer\Arionum\Models\Transaction;

/**
 * @method static string getAddress(string $publicKey)
 * @method static string getBase58(string $data)
 * @method static string getBalance(string $address)
 * @method static string getBalanceByAlias(string $alias)
 * @method static string getBalanceByPublicKey(string $publicKey)
 * @method static string getPendingBalance(string $address)
 * @method static array getTransactions(string $address, int $limit = 100)
 * @method static array getTransactionsByPublicKey(string $publicKey, int $limit = 100)
 * @method static stdClass getTransaction(string $transactionId)
 * @method static string getPublicKey(string $address)
 * @method static stdClass generateAccount()
 * @method static stdClass getCurrentBlock()
 * @method static stdClass getBlock(int $height)
 * @method static array getBlockTransactions(string $blockId)
 * @method static string getNodeVersion()
 * @method static string sendTransaction(Transaction $transaction)
 * @method static int getMempoolSize()
 * @method static int getRandomNumber(int $height, int $minimum, int $maximum, ?string $seed = null)
 * @method static bool checkSignature(string $signature, string $data, string $publicKey)
 * @method static array getMasternodes()
 * @method static string getAlias(string $address)
 * @method static stdClass getSanityDetails()
 * @method static stdClass getNodeInfo()
 * @method static bool checkAddress(string $address, ?string $publicKey = null)
 * @method static array getAssetBalance(string $address)
 * @method static array getAssetOrders(string $address, ?string $assetId)
 * @method static string getNodeAddress()
 *
 * @see Arionum
 */
final class ArionumFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'arionum';
    }
}
