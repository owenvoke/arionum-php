<?php

namespace pxgamer\Arionum\Laravel;

use stdClass;
use pxgamer\Arionum\Arionum;
use Illuminate\Support\Facades\Facade;
use pxgamer\Arionum\Models\Transaction;

/**
 * @method string getAddress(string $publicKey)
 * @method string getBase58(string $data)
 * @method string getBalance(string $address)
 * @method string getBalanceByAlias(string $alias)
 * @method string getBalanceByPublicKey(string $publicKey)
 * @method string getPendingBalance(string $address)
 * @method array getTransactions(string $address, int $limit = 100)
 * @method array getTransactionsByPublicKey(string $publicKey, int $limit = 100)
 * @method stdClass getTransaction(string $transactionId)
 * @method string getPublicKey(string $address)
 * @method stdClass generateAccount()
 * @method stdClass getCurrentBlock()
 * @method stdClass getBlock(int $height)
 * @method array getBlockTransactions(string $blockId)
 * @method string getNodeVersion()
 * @method string sendTransaction(Transaction $transaction)
 * @method int getMempoolSize()
 * @method int getRandomNumber(int $height, int $minimum, int $maximum, ?string $seed = null)
 * @method bool checkSignature(string $signature, string $data, string $publicKey)
 * @method array getMasternodes()
 * @method string getAlias(string $address)
 * @method stdClass getSanityDetails()
 * @method stdClass getNodeInfo()
 * @method bool checkAddress(string $address, ?string $publicKey = null)
 * @method array getAssetBalance(string $address)
 * @method string getNodeAddress()
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
