<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use OwenVoke\Arionum\Arionum;
use OwenVoke\Arionum\Exceptions\GenericApiException;
use OwenVoke\Arionum\Tests\TestCase;

beforeEach()->withArionum();

it('getsTheNodeAddress', function (): void {
    $data = $this->arionum->getNodeAddress();
    assertEquals(TestCase::TEST_NODE, $data);
});

it('gets the version for the current node', function (): void {
    $data = $this->arionum->getNodeVersion();
    assertNotEmpty($data);
});

it('gets the sanity details for the current node', function (): void {
    $data = $this->arionum->getSanityDetails();

    assertIsBool($data->sanity_running);
    assertIsNumeric($data->last_sanity);
    assertIsBool($data->sanity_sync);
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

    assertIsString($data->hostname);
    assertIsString($data->version);
    assertIsString($data->dbversion);
    assertIsInt($data->accounts);
    assertIsInt($data->transactions);
    assertIsInt($data->mempool);
    assertIsInt($data->masternodes);

    assertEquals('https://aro.example.com', $data->hostname);
});
