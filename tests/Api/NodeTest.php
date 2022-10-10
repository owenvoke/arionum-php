<?php

declare(strict_types=1);

use OwenVoke\Arionum\Api\Node;

beforeEach(fn () => $this->apiClass = Node::class);

it('can get the version of the current node', function () {
    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/api.php', [
            'q' => 'version',
        ])
        ->willReturn('1.0.0-alpha.7');

    /** @var Node $api */
    expect(
        $api->version()
    )->toBe('1.0.0-alpha.7');
});

it('can get information about the current node', function () {
    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/api.php', [
            'q' => 'node-info',
        ])
        ->willReturn([
            'hostname' => 'http://peer1.arionum.com',
            'version' => '1.0.0-alpha.7',
            'dbversion' => '12',
            'accounts' => 16201,
            'transactions' => 10300617,
            'mempool' => 2,
            'masternodes' => 600,
            'peers' => 23,
        ]);

    /** @var Node $api */
    expect(
        $api->info()
    )->toBe([
        'hostname' => 'http://peer1.arionum.com',
        'version' => '1.0.0-alpha.7',
        'dbversion' => '12',
        'accounts' => 16201,
        'transactions' => 10300617,
        'mempool' => 2,
        'masternodes' => 600,
        'peers' => 23,
    ]);
});

it('can get the sanity details for the current node', function () {
    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/api.php', [
            'q' => 'sanity',
        ])
        ->willReturn([
            'sanity_running' => false,
            'last_sanity' => 1665409622,
            'sanity_sync' => false,
        ]);

    /** @var Node $api */
    expect(
        $api->sanity()
    )->toBe([
        'sanity_running' => false,
        'last_sanity' => 1665409622,
        'sanity_sync' => false,
    ]);
});

it('can get a list of masternodes', function () {
    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/api.php', [
            'q' => 'masternodes',
        ])
        ->willReturn([
            'hash' => 'c7d66b357c05d0908623a09afd387dd3',
            'masternodes' => [
                [
                    'public_key' => "PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSCvNFCyZbpNpLVwg4Sk8Pe46dyKrqR4GacBGtaeJ9CAXQTc41jYrW2gy91XUkBgMkkAjqsojSVMJ1iasdbcmFdx7wy",
                    'height' => 104148,
                    'ip' => "35.237.72.244",
                    'last_won' => 137074,
                    'blacklist' => 0,
                    'fails' => 0,
                    'status' => 0,
                    'vote_key' => null,
                    'cold_last_won' => 1719924,
                    'voted' => 0,
                ],
            ],
        ]);

    /** @var Node $api */
    expect(
        $api->masternodes()
    )->toBe([
        'hash' => 'c7d66b357c05d0908623a09afd387dd3',
        'masternodes' => [
            [
                'public_key' => "PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSCvNFCyZbpNpLVwg4Sk8Pe46dyKrqR4GacBGtaeJ9CAXQTc41jYrW2gy91XUkBgMkkAjqsojSVMJ1iasdbcmFdx7wy",
                'height' => 104148,
                'ip' => "35.237.72.244",
                'last_won' => 137074,
                'blacklist' => 0,
                'fails' => 0,
                'status' => 0,
                'vote_key' => null,
                'cold_last_won' => 1719924,
                'voted' => 0,
            ],
        ],
    ]);
});
