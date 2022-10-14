<?php

declare(strict_types=1);

use OwenVoke\Arionum\Api\Account;

beforeEach(fn () => $this->apiClass = Account::class);

it('can generate an account', function () {
    $api = $this->getApiMock();

    /** @var Account $api */
    expect($api->generate())->toHaveKeys([
        'address',
        'public_key',
        'private_key',
    ])
        ->public_key->toStartWith('PZ8')
        ->private_key->toStartWith('Lzh');
});

it('can get an address by public key', function () {
    $api = $this->getApiMock();

    /** @var Account $api */
    expect(
        $api->address('PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSCyk7aKeBJ6LL44w5JGSFp82Wb1Drqicuznv1qmRVQMvbmF64AeczjMtV72acGLR9RsiQ2JccemNrSPkKi8KDk72t4')
    )->toBe('51sJ4LbdKzhyGy4zJGqodNLse9n9JsVT2rdeH92w7cf3qQuSDJupvjbUT1UBr7r1SCUAXG97saxn7jt2edKb4v4J');
});

it('can get the balance for an address', function () {
    $api = $this->getApiMock();

    /** @var Account $api */
    expect(
        $api->balance('51sJ4LbdKzhyGy4zJGqodNLse9n9JsVT2rdeH92w7cf3qQuSDJupvjbUT1UBr7r1SCUAXG97saxn7jt2edKb4v4J')
    )->toBe(0.00044441);
});

it('can get the balance for an alias', function () {
    $api = $this->getApiMock();

    /** @var Account $api */
    expect(
        $api->balanceByAlias('PXGAMER')
    )->toBe(0.00044441);
});

it('can get the balance for a public key', function () {
    $api = $this->getApiMock();

    /** @var Account $api */
    expect(
        $api->balanceForPublicKey('PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSCyPP8v9FpH75La76KNgkUpZ2KiMHxHQsUKFytyEMXFPkh3yC25p5JoiR1dEsTgJJkNSrrkTM96BcMae5h6NeSdrH1')
    )->toBe(0.0);
});

it('can get the pending balance for an address', function () {
    $api = $this->getApiMock();

    /** @var Account $api */
    expect(
        $api->pendingBalance('2tR6BWvwpwrQLUWN8GpVP4b6srCxgR2PnrsXs7jYfdeBj3FimJ5Tjd4xzWcWe8y59ZtEBXgQJxe6Uibux1cCDfxL')
    )->toBe(0.0);
});

it('can get the pending balance for a public key', function () {
    $api = $this->getApiMock();

    /** @var Account $api */
    expect(
        $api->pendingBalanceForPublicKey('PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSCyPP8v9FpH75La76KNgkUpZ2KiMHxHQsUKFytyEMXFPkh3yC25p5JoiR1dEsTgJJkNSrrkTM96BcMae5h6NeSdrH1')
    )->toBe(0.0);
});

it('can get the alias for an address', function () {
    $api = $this->getApiMock();

    /** @var Account $api */
    expect(
        $api->alias('51sJ4LbdKzhyGy4zJGqodNLse9n9JsVT2rdeH92w7cf3qQuSDJupvjbUT1UBr7r1SCUAXG97saxn7jt2edKb4v4J')
    )->toBe('PXGAMER');
});

it('can get check that an address is valid', function () {
    $api = $this->getApiMock();

    /** @var Account $api */
    expect(
        $api->checkAddress('2tR6BWvwpwrQLUWN8GpVP4b6srCxgR2PnrsXs7jYfdeBj3FimJ5Tjd4xzWcWe8y59ZtEBXgQJxe6Uibux1cCDfxL')
    )->toBe(true);
});
