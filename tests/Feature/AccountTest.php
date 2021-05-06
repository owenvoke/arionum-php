<?php

declare(strict_types=1);

beforeEach()->withArionum();

$testAddress = '51sJ4LbdKzhyGy4zJGqodNLse9n9JsVT2rdeH92w7cf3qQuSDJupvjbUT1UBr7r1SCUAXG97saxn7jt2edKb4v4J';
$testPublicKey = 'PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSCyk7aKeBJ6LL44w5JGSFp82Wb1Drqicuznv1qmRVQMvbmF64AeczjMtV72acGLR9RsiQ2JccemNrSPkKi8KDk72t4';

it('generates a new account', function (): void {
    $data = $this->arionum->generateAccount();

    expect($data->getPublicKey())->toStartWith('PZ');
    expect($data->getPrivateKey())->toStartWith('Lz');
});

it('gets the balance for a test address', function () use ($testAddress): void {
    $data = $this->arionum->getBalance($testAddress);
    expect($data)->toBeNumeric();
});

it('gets the balance for a test alias', function (): void {
    $data = $this->arionum->getBalanceByAlias('PXGAMER');
    expect($data)->toBeNumeric();
});

it('gets the balance for a public key', function () use ($testPublicKey): void {
    $data = $this->arionum->getBalanceByPublicKey($testPublicKey);
    expect($data)->toBeNumeric();
});

it('gets the pending balance for a public key', function () use ($testPublicKey): void {
    $data = $this->arionum->getPendingBalance($testPublicKey);
    expect($data)->toBeNumeric();
});

it('gets the transactions for an address', function () use ($testAddress): void {
    $data = $this->arionum->getTransactions($testAddress);
    expect($data)->toBeArray()->not->toBeEmpty();
});

it('gets the transactions for a public key', function () use ($testPublicKey): void {
    $data = $this->arionum->getTransactionsByPublicKey($testPublicKey);
    expect($data)->toBeArray()->not->toBeEmpty();
});

it('gets the alias for an address', function () use ($testAddress): void {
    $data = $this->arionum->getAlias($testAddress);
    expect($data)->toEqual('PXGAMER');
});

it('checks that an address is valid', function () use ($testAddress): void {
    $data = $this->arionum->checkAddress($testAddress);
    expect($data)->toBeTrue();
});
