<?php

declare(strict_types=1);

beforeEach()->withArionum();

it('gets the current block', function (): void {
    $data = $this->arionum->getCurrentBlock();

    expect($data)->toHaveProperty('id')->toHaveProperty('signature');
});

it('gets a block by its height', function (): void {
    $data = $this->arionum->getBlock(1);

    expect($data)->toHaveProperty('id')->toHaveProperty('signature');
});

it('gets the transactions for a specific block', function (): void {
    $testBlockId = 'ceiirEsfXyQh3Tnyp6RuSnRANAxNW7BvVGxDUzKFcBH9yHfPa1Jq2oPGH7P41X6Puwn2ajtydn1aHSPhV8X8Sg2';
    $data = $this->arionum->getBlockTransactions($testBlockId);

    expect($data)->toBeArray()->not->toBeEmpty();
});
