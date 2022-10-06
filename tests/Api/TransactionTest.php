<?php

declare(strict_types=1);

use OwenVoke\Arionum\Api\Transaction;
use OwenVoke\Arionum\Enums\TransactionVersion;

beforeEach(fn () => $this->apiClass = Transaction::class);

it('can get the transactions for an address');

it('can get the transactions for a public key');

it('can get a specific transaction');

it('can create a transaction')->with(TransactionVersion::cases());

it('can get the number of transactions in the mempool');
