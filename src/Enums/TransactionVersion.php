<?php

declare(strict_types=1);

namespace OwenVoke\Arionum\Enums;

enum TransactionVersion: int
{
    /** The transaction version for resuming a masternode. */
    case MASTERNODE_RESUME = 102;
    /** The transaction version for releasing a masternode. */
    case MASTERNODE_RELEASE = 103;
    /** The transaction version for pausing a masternode. */
    case MASTERNODE_PAUSE = 101;
    /** The transaction version for creating an asset. */
    case ASSET_CREATE = 50;
    /** The transaction version for distributing dividends for an asset. */
    case ASSET_DIVIDENDS = 54;
    /** The transaction version for cancelling a market order for an asset. */
    case ASSET_CANCEL_ORDER = 53;
    /** The transaction version for increasing the max supply of an asset. */
    case ASSET_INFLATE = 55;
    /** The transaction version for a masternode blacklist vote. */
    case MASTERNODE_VOTE_BLACKLIST = 106;
    /** The transaction version for sending units of an asset. */
    case ASSET_SEND = 51;
    /** The transaction version for adding a masternode voting key. */
    case MASTERNODE_ADD_VOTING_KEY = 105;
    /** The transaction version for updating a masternodes IP address. */
    case MASTERNODE_UPDATE_IP = 104;
    /** The transaction version for sending to an alias. */
    case ALIAS_SEND = 2;
    /** The transaction version for creating a masternode. */
    case MASTERNODE_CREATE = 100;
    /** The transaction version for setting an alias. */
    case ALIAS_SET = 3;
    /** The transaction version for sending to an address. */
    case STANDARD = 1;
    /** The transaction version for creating a market ask/bid order for an asset. */
    case ASSET_MARKET = 52;
    /** The transaction version for a masternode blockchain vote. */
    case MASTERNODE_VOTE_BLOCKCHAIN = 107;
}
