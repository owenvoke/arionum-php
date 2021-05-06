<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use OwenVoke\Arionum\Tests\TestCase;

beforeEach()->withArionum();

it('getsTheNodeAddress', function (): void {
    $data = $this->arionum->getNodeAddress();
    expect($data)->toEqual(TestCase::TEST_NODE);
});

it('gets the version for the current node', function (): void {
    $data = $this->arionum->getNodeVersion();
    expect($data)->not->toBeEmpty();
});

it('gets the sanity details for the current node', function (): void {
    $data = $this->arionum->getSanityDetails();

    expect($data->sanity_running)->toBeBool();
    expect($data->last_sanity)->toBeNumeric();
    expect($data->sanity_sync)->toBeBool();
});

it('gets the information for the current node', function (): void {
    $mock = new MockHandler([
        new Response(200, [], json_encode([
            'status' => 'ok',
            'data' => [
                'hostname' => 'https://aro.example.com',
                'version' => '0.4.5',
                'dbversion' => '9',
                'accounts' => 14817,
                'transactions' => 2779519,
                'mempool' => 8,
                'masternodes' => 484,
                'peers' => 108,
            ],
            'coin' => 'arionum',
        ], JSON_THROW_ON_ERROR)),
    ]);

    $handler = HandlerStack::create($mock);
    $client = new Client(['handler' => $handler]);

    $this->withArionum(null, $client);

    $data = $this->arionum->getNodeInfo();

    expect($data->hostname)->toBeString();
    expect($data->version)->toBeString();
    expect($data->dbversion)->toBeString();
    expect($data->accounts)->toBeInt();
    expect($data->transactions)->toBeInt();
    expect($data->mempool)->toBeInt();
    expect($data->masternodes)->toBeInt();

    expect($data->hostname)->toEqual('https://aro.example.com');
});
