<?php

declare(strict_types=1);

use OwenVoke\Arionum\Api\Block;

beforeEach(fn () => $this->apiClass = Block::class);

it('can get the current block', function () {
    $api = $this->getApiMock();

    /** @var Block $api */
    expect(
        $api->currentBlock()
    )->toHaveKeys([
        'id',
        'generator',
        'height',
        'date',
        'nonce',
        'signature',
        'difficulty',
        'argon',
        'transactions',
    ]);
});

it('can get a specific block by its height', function () {
    $api = $this->getApiMock();

    /** @var Block $api */
    expect(
        $api->block(1720339)
    )->toBe([
        'id' => 'dkhnqpyPW2JLD574yCiS6a39FeWyWZT1w61JLbdntBC1anT9rn1S76sFQX1eqSnEe2AA5PrG6RW8hSF7aKGR9US',
        'generator' => '5ADfrJUnLefPsaYjMTR4KmvQ79eHo2rYWnKBRCXConYKYJVAw2adtzb38oUG5EnsXEbTct3p7GagT2VVZ9hfVTVn',
        'height' => 1720339,
        'date' => 1665409519,
        'nonce' => '01yIM9KRxIUYuS7348pmVy0ToOq1KVEUoCr4tvzZ5rIn',
        'signature' => 'AN1rKvsxEc94WQvPAtKh7U38QvXTkeksjSg5uQqKd7gFpCjRYaw1cEfQNswNMuCzt6xnZ8x3bmisvDou2R1txd9CsPPPoA3Kk',
        'difficulty' => '10083709908',
        'argon' => '$b0RNZjRjT0tVaFNvb3ZzTw$OxKPTgidQHHJhapYov925s5hljQNYukg38XFh9gsypI',
        'transactions' => 0,
    ]);
});

it('can get the transactions for a block', function () {
    $api = $this->getApiMock();

    /** @var Block $api */
    expect(
        $api->transactions(1720339)
    )->toBe([]);
});

it('can get the transactions for a block by its id', function () {
    $api = $this->getApiMock();

    /** @var Block $api */
    expect(
        $api->transactionsById('26PZgwak3LscM3Mz8bfDBmbETSq9GvXhdom5HwoDMuaMvg9cekKX21hoNtJXixdrvvAwq2BoxKiUdQQnGWym1ZxT')
    )->toBe([]);
});
