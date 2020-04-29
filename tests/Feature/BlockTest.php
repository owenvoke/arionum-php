<?php

declare(strict_types=1);

use OwenVoke\Arionum\Arionum;
use OwenVoke\Arionum\Tests\TestCase;

beforeEach(function (): void {
    $this->arionum = new Arionum(TestCase::TEST_NODE);
});

it('gets the current block', function (): void {
    $data = $this->arionum->getCurrentBlock();

    assertObjectHasAttribute('id', $data);
    assertObjectHasAttribute('signature', $data);
});

it('gets a block by its height', function (): void {
    $data = $this->arionum->getBlock(1);

    assertObjectHasAttribute('id', $data);
    assertObjectHasAttribute('signature', $data);
});

it('gets the transactions for a specific block', function (): void {
    $testBlockId = 'ceiirEsfXyQh3Tnyp6RuSnRANAxNW7BvVGxDUzKFcBH9yHfPa1Jq2oPGH7P41X6Puwn2ajtydn1aHSPhV8X8Sg2';
    $data = $this->arionum->getBlockTransactions($testBlockId);

    assertIsArray($data);
    assertNotEmpty($data);
});
