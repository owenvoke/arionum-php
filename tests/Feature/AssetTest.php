<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

$testAddress = '51sJ4LbdKzhyGy4zJGqodNLse9n9JsVT2rdeH92w7cf3qQuSDJupvjbUT1UBr7r1SCUAXG97saxn7jt2edKb4v4J';
$testAsset = 'aro';

it('can retrieve an asset balance', function () use ($testAddress): void {
    $mock = new MockHandler([
        new Response(200, [], '{"data": [], "status": "ok"}'),
    ]);

    $handler = HandlerStack::create($mock);
    $client = new Client(['handler' => $handler]);

    $this->withArionum(null, $client);

    $data = $this->arionum->getAssetBalance($testAddress);

    expect($data)->toBeArray()->toBeEmpty();
});

it('can retrieve orders for an asset', function () use ($testAddress): void {
    $mock = new MockHandler([
        new Response(200, [], '{"data": [], "status": "ok"}'),
    ]);

    $handler = HandlerStack::create($mock);
    $client = new Client(['handler' => $handler]);

    $this->withArionum(null, $client);

    $data = $this->arionum->getAssetOrders($testAddress);

    expect($data)->toBeArray()->toBeEmpty();
});

it('can retrieve available assets', function (): void {
    $mock = new MockHandler([
        new Response(200, [], '{"data": [], "status": "ok"}'),
    ]);

    $handler = HandlerStack::create($mock);
    $client = new Client(['handler' => $handler]);

    $this->withArionum(null, $client);

    $data = $this->arionum->getAssets();

    expect($data)->toBeArray()->toBeEmpty();
});

it('can retrieve an asset', function () use ($testAsset): void {
    $mock = new MockHandler([
        new Response(200, [], '{"data": [], "status": "ok"}'),
    ]);

    $handler = HandlerStack::create($mock);
    $client = new Client(['handler' => $handler]);

    $this->withArionum(null, $client);

    $data = $this->arionum->getAsset($testAsset);

    expect($data)->toBeArray()->toBeEmpty();
});
