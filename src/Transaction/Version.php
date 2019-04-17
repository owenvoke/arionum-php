<?php

namespace pxgamer\Arionum\Transaction;

final class Version
{
    /** @var int The transaction version for sending to an address. */
    public const STANDARD = 1;
    /** @var int The transaction version for sending to an alias. */
    public const ALIAS_SEND = 2;
    /** @var int The transaction version for setting an alias. */
    public const ALIAS_SET = 3;

    /** @var int The transaction version for creating an asset. */
    public const ASSET_CREATE = 50;
    /** @var int The transaction version for sending units of an asset. */
    public const ASSET_SEND = 51;
    /** @var int The transaction version for creating a market ask/bid order for an asset. */
    public const ASSET_MARKET = 52;
    /** @var int The transaction version for cancelling a market order for an asset. */
    public const ASSET_CANCEL_ORDER = 53;
    /** @var int The transaction version for distributing dividends for an asset. */
    public const ASSET_DIVIDENDS = 54;
    /** @var int The transaction version for increasing the max supply of an asset. */
    public const ASSET_INFLATE = 55;

    /** @var int The transaction version for creating a masternode. */
    public const MASTERNODE_CREATE = 100;
    /** @var int The transaction version for pausing a masternode. */
    public const MASTERNODE_PAUSE = 101;
    /** @var int The transaction version for resuming a masternode. */
    public const MASTERNODE_RESUME = 102;
    /** @var int The transaction version for releasing a masternode. */
    public const MASTERNODE_RELEASE = 103;
}
