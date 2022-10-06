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

it('can get an address by public key');

it('can get the balance for an address');

it('can get the balance for an alias');

it('can get the balance for a public key');

it('can get the pending balance for a public key');

it('can get the alias for an address');

it('can get check that an address is valid');
