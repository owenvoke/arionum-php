<?php

declare(strict_types=1);

use OwenVoke\Arionum\Api\Node;

beforeEach(fn () => $this->apiClass = Node::class);

it('can get the version of the current node', function () {
    $api = $this->getApiMock();

    /** @var Node $api */
    expect(
        $api->version()
    )->toBe('1.0.0-alpha.7');
});

it('can get information about the current node', function () {
    $api = $this->getApiMock();

    /** @var Node $api */
    expect(
        $api->info()
    )->toHaveKeys([
        'hostname',
        'version',
        'dbversion',
        'accounts',
        'transactions',
        'mempool',
        'masternodes',
        'peers',
    ]);
});

it('can get the sanity details for the current node', function () {
    $api = $this->getApiMock();

    /** @var Node $api */
    expect(
        $api->sanity()
    )->toHaveKeys([
        'sanity_running',
        'last_sanity',
        'sanity_sync',
    ]);
});

it('can get a list of masternodes', function () {
    $api = $this->getApiMock();

    /** @var Node $api */
    expect(
        $api->masternodes()
    )
        ->toBeArray()->toHaveKeys([
            'hash',
            'masternodes',
        ])
        ->masternodes->{0}->toHaveKeys([
            'public_key',
            'height',
            'ip',
            'last_won',
            'blacklist',
            'fails',
            'status',
            'vote_key',
            'cold_last_won',
            'voted',
        ]);
});
