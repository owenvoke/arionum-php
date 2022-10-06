<?php

declare(strict_types=1);

use OwenVoke\Arionum\Api\Account;

beforeEach(fn () => $this->apiClass = Account::class);

it('can generate an account', function () {
    $response = [
        'data' => [
            'address' => '2tR6BWvwpwrQLUWN8GpVP4b6srCxgR2PnrsXs7jYfdeBj3FimJ5Tjd4xzWcWe8y59ZtEBXgQJxe6Uibux1cCDfxL',
            'public_key' => 'PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSCyPP8v9FpH75La76KNgkUpZ2KiMHxHQsUKFytyEMXFPkh3yC25p5JoiR1dEsTgJJkNSrrkTM96BcMae5h6NeSdrH1',
            'private_key' => 'Lzhp9LopCF2mJMHtXj13vuZorf5qMDmYYpjBMLcUshSyyycjFt7YqSjFrzK4AUFpRWw3XPBYcA2maavRp1kbDe7iHwcLaTVwQ6sH2n5vRqZSoAzvcx4JHACDSF4K6TzA3WdspLXZYKbq612psVmtqBuYwvUkDhd2j',
        ],
    ];

    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/api.php', [
            'q' => 'generateAccount',
        ])
        ->willReturn($response);

    /** @var Account $api */
    expect($api->generate())->toBe($response);
});

it('can get an address by public key', function () {
    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/api.php', [
            'q' => 'getAddress',
            'public_key' => 'PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSCyPP8v9FpH75La76KNgkUpZ2KiMHxHQsUKFytyEMXFPkh3yC25p5JoiR1dEsTgJJkNSrrkTM96BcMae5h6NeSdrH1',
        ])
        ->willReturn('2tR6BWvwpwrQLUWN8GpVP4b6srCxgR2PnrsXs7jYfdeBj3FimJ5Tjd4xzWcWe8y59ZtEBXgQJxe6Uibux1cCDfxL');

    /** @var Account $api */
    expect(
        $api->address('PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSCyPP8v9FpH75La76KNgkUpZ2KiMHxHQsUKFytyEMXFPkh3yC25p5JoiR1dEsTgJJkNSrrkTM96BcMae5h6NeSdrH1')
    )->toBe('2tR6BWvwpwrQLUWN8GpVP4b6srCxgR2PnrsXs7jYfdeBj3FimJ5Tjd4xzWcWe8y59ZtEBXgQJxe6Uibux1cCDfxL');
});

it('can get the balance for an address', function () {
    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/api.php', [
            'q' => 'getBalance',
            'account' => '2tR6BWvwpwrQLUWN8GpVP4b6srCxgR2PnrsXs7jYfdeBj3FimJ5Tjd4xzWcWe8y59ZtEBXgQJxe6Uibux1cCDfxL',
        ])
        ->willReturn('0');

    /** @var Account $api */
    expect(
        $api->balance('2tR6BWvwpwrQLUWN8GpVP4b6srCxgR2PnrsXs7jYfdeBj3FimJ5Tjd4xzWcWe8y59ZtEBXgQJxe6Uibux1cCDfxL')
    )->toBe(0.0);
});

it('can get the balance for an alias', function () {
    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/api.php', [
            'q' => 'getBalance',
            'alias' => 'dev',
        ])
        ->willReturn('0');

    /** @var Account $api */
    expect(
        $api->balanceByAlias('dev')
    )->toBe(0.0);
});

it('can get the balance for a public key', function () {
    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/api.php', [
            'q' => 'getBalance',
            'public_key' => 'PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSCyPP8v9FpH75La76KNgkUpZ2KiMHxHQsUKFytyEMXFPkh3yC25p5JoiR1dEsTgJJkNSrrkTM96BcMae5h6NeSdrH1',
        ])
        ->willReturn('0');

    /** @var Account $api */
    expect(
        $api->balanceForPublicKey('PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSCyPP8v9FpH75La76KNgkUpZ2KiMHxHQsUKFytyEMXFPkh3yC25p5JoiR1dEsTgJJkNSrrkTM96BcMae5h6NeSdrH1')
    )->toBe(0.0);
});

it('can get the pending balance for an address', function () {
    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/api.php', [
            'q' => 'getPendingBalance',
            'account' => '2tR6BWvwpwrQLUWN8GpVP4b6srCxgR2PnrsXs7jYfdeBj3FimJ5Tjd4xzWcWe8y59ZtEBXgQJxe6Uibux1cCDfxL',
        ])
        ->willReturn('0');

    /** @var Account $api */
    expect(
        $api->pendingBalance('2tR6BWvwpwrQLUWN8GpVP4b6srCxgR2PnrsXs7jYfdeBj3FimJ5Tjd4xzWcWe8y59ZtEBXgQJxe6Uibux1cCDfxL')
    )->toBe(0.0);
});

it('can get the pending balance for a public key', function () {
    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/api.php', [
            'q' => 'getPendingBalance',
            'public_key' => 'PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSCyPP8v9FpH75La76KNgkUpZ2KiMHxHQsUKFytyEMXFPkh3yC25p5JoiR1dEsTgJJkNSrrkTM96BcMae5h6NeSdrH1',
        ])
        ->willReturn('0');

    /** @var Account $api */
    expect(
        $api->pendingBalanceForPublicKey('PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSCyPP8v9FpH75La76KNgkUpZ2KiMHxHQsUKFytyEMXFPkh3yC25p5JoiR1dEsTgJJkNSrrkTM96BcMae5h6NeSdrH1')
    )->toBe(0.0);
});

it('can get the alias for an address', function () {
    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/api.php', [
            'q' => 'getAlias',
            'account' => '2tR6BWvwpwrQLUWN8GpVP4b6srCxgR2PnrsXs7jYfdeBj3FimJ5Tjd4xzWcWe8y59ZtEBXgQJxe6Uibux1cCDfxL',
        ])
        ->willReturn('dev');

    /** @var Account $api */
    expect(
        $api->alias('2tR6BWvwpwrQLUWN8GpVP4b6srCxgR2PnrsXs7jYfdeBj3FimJ5Tjd4xzWcWe8y59ZtEBXgQJxe6Uibux1cCDfxL')
    )->toBe('dev');
});

it('can get check that an address is valid', function () {
    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/api.php', [
            'q' => 'checkAddress',
            'public_key' => null,
            'account' => '2tR6BWvwpwrQLUWN8GpVP4b6srCxgR2PnrsXs7jYfdeBj3FimJ5Tjd4xzWcWe8y59ZtEBXgQJxe6Uibux1cCDfxL',
        ])
        ->willReturn('true');

    /** @var Account $api */
    expect(
        $api->checkAddress('2tR6BWvwpwrQLUWN8GpVP4b6srCxgR2PnrsXs7jYfdeBj3FimJ5Tjd4xzWcWe8y59ZtEBXgQJxe6Uibux1cCDfxL')
    )->toBe(true);
});
