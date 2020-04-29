<?php

declare(strict_types=1);

beforeEach()->withArionum();

$testAddress = '51sJ4LbdKzhyGy4zJGqodNLse9n9JsVT2rdeH92w7cf3qQuSDJupvjbUT1UBr7r1SCUAXG97saxn7jt2edKb4v4J';
$testPublicKey = 'PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSCyk7aKeBJ6LL44w5JGSFp82Wb1Drqicuznv1qmRVQMvbmF64AeczjMtV72acGLR9RsiQ2JccemNrSPkKi8KDk72t4';

it('generates a new account', function (): void {
    $data = $this->arionum->generateAccount();
    assertStringStartsWith('PZ', $data->getPublicKey());
    assertStringStartsWith('Lz', $data->getPrivateKey());
});

it('gets the balance for a test address', function () use ($testAddress): void {
    $data = $this->arionum->getBalance($testAddress);
    assertIsNumeric($data);
});

it('gets the balance for a test alias', function (): void {
    $data = $this->arionum->getBalanceByAlias('PXGAMER');
    assertIsNumeric($data);
});

it('gets the balance for a public key', function () use ($testPublicKey): void {
    $data = $this->arionum->getBalanceByPublicKey($testPublicKey);
    assertIsNumeric($data);
});

it('gets the pending balance for a public key', function () use ($testPublicKey): void {
    $data = $this->arionum->getPendingBalance($testPublicKey);
    assertIsNumeric($data);
});

it('gets the transactions for an address', function () use ($testAddress): void {
    $data = $this->arionum->getTransactions($testAddress);
    assertIsArray($data);
    assertNotEmpty($data);
});

it('gets the transactions for a public key', function () use ($testPublicKey): void {
    $data = $this->arionum->getTransactionsByPublicKey($testPublicKey);
    assertIsArray($data);
    assertNotEmpty($data);
});

it('gets the alias for an address', function () use ($testAddress): void {
    $data = $this->arionum->getAlias($testAddress);
    assertEquals('PXGAMER', $data);
});

it('checks that an address is valid', function () use ($testAddress): void {
    $data = $this->arionum->checkAddress($testAddress);
    assertTrue($data);
});
