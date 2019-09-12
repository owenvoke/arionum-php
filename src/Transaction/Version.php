<?php

declare(strict_types=1);

namespace pxgamer\Arionum\Transaction;

final class Version
{
    /** The transaction version for sending to an address. */
    public const STANDARD = 1;
    /** The transaction version for sending to an alias. */
    public const ALIAS_SEND = 2;
    /** The transaction version for setting an alias. */
    public const ALIAS_SET = 3;

    /** The transaction version for creating an asset. */
    public const ASSET_CREATE = 50;
    /** The transaction version for sending units of an asset. */
    public const ASSET_SEND = 51;
    /** The transaction version for creating a market ask/bid order for an asset. */
    public const ASSET_MARKET = 52;
    /** The transaction version for cancelling a market order for an asset. */
    public const ASSET_CANCEL_ORDER = 53;
    /** The transaction version for distributing dividends for an asset. */
    public const ASSET_DIVIDENDS = 54;
    /** The transaction version for increasing the max supply of an asset. */
    public const ASSET_INFLATE = 55;

    /** The transaction version for creating a masternode. */
    public const MASTERNODE_CREATE = 100;
    /** The transaction version for pausing a masternode. */
    public const MASTERNODE_PAUSE = 101;
    /** The transaction version for resuming a masternode. */
    public const MASTERNODE_RESUME = 102;
    /** The transaction version for releasing a masternode. */
    public const MASTERNODE_RELEASE = 103;
    /** The transaction version for updating a masternodes IP address. */
    public const MASTERNODE_UPDATE_IP = 104;
    /** The transaction version for adding a masternode voting key. */
    public const MASTERNODE_ADD_VOTING_KEY = 105;
    /** The transaction version for a masternode blacklist vote. */
    public const MASTERNODE_BLACKLIST_VOTE = 106;
    /** The transaction version for a masternode blockchain vote. */
    public const MASTERNODE_BLOCKCHAIN_VOTE = 107;
}
