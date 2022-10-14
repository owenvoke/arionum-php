<?php

declare(strict_types=1);

use OwenVoke\Arionum\Api\Asset;

beforeEach(fn () => $this->apiClass = Asset::class);

it('can get all assets', function () {
    $api = $this->getApiMock();

    /** @var Asset $api */
    expect(
        $api->all()
    )->toBeArray()->not->toBeEmpty()
        ->{0}->toBe([
            'id' => '26PZgwak3LscM3Mz8bfDBmbETSq9GvXhdom5HwoDMuaMvg9cekKX21hoNtJXixdrvvAwq2BoxKiUdQQnGWym1ZxT',
            'max_supply' => 0,
            'tradable' => 1,
            'price' => '0.00000000',
            'dividend_only' => 0,
            'auto_dividend' => 0,
            'allow_bid' => 1,
            'height' => 952581,
            'alias' => 'AUSDTHOUSAND',
            'balance' => '39.62500000',
        ]);
});

it('can get a specific asset', function () {
    $api = $this->getApiMock();

    /** @var Asset $api */
    expect(
        $api->show('26PZgwak3LscM3Mz8bfDBmbETSq9GvXhdom5HwoDMuaMvg9cekKX21hoNtJXixdrvvAwq2BoxKiUdQQnGWym1ZxT')
    )->toBe([
        [
            'id' => '26PZgwak3LscM3Mz8bfDBmbETSq9GvXhdom5HwoDMuaMvg9cekKX21hoNtJXixdrvvAwq2BoxKiUdQQnGWym1ZxT',
            'max_supply' => 0,
            'tradable' => 1,
            'price' => '0.00000000',
            'dividend_only' => 0,
            'auto_dividend' => 0,
            'allow_bid' => 1,
            'height' => 952581,
            'alias' => 'AUSDTHOUSAND',
            'balance' => '39.62500000',
        ],
    ]);
});

it('can get the asset balance for an account', function () {
    $api = $this->getApiMock();

    /** @var Asset $api */
    expect(
        $api->balance('2tR6BWvwpwrQLUWN8GpVP4b6srCxgR2PnrsXs7jYfdeBj3FimJ5Tjd4xzWcWe8y59ZtEBXgQJxe6Uibux1cCDfxL')
    )->toBe(0.0);
});

it('can get the asset orders for an address', function () {
    $api = $this->getApiMock();

    /** @var Asset $api */
    expect(
        $api->orders(
            '2tR6BWvwpwrQLUWN8GpVP4b6srCxgR2PnrsXs7jYfdeBj3FimJ5Tjd4xzWcWe8y59ZtEBXgQJxe6Uibux1cCDfxL',
            '26PZgwak3LscM3Mz8bfDBmbETSq9GvXhdom5HwoDMuaMvg9cekKX21hoNtJXixdrvvAwq2BoxKiUdQQnGWym1ZxT'
        )
    )->toBe([]);
});