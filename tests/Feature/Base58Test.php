<?php

declare(strict_types=1);

use OwenVoke\Arionum\Arionum;
use OwenVoke\Arionum\Tests\TestCase;

beforeEach(function (): void {
    $this->arionum = new Arionum(TestCase::TEST_NODE);
});

it('gets a base58 value for input data', function (): void {
    $inputData = 'dataIsHere';
    $outputData = '6e6WaupsT6FzH2';

    $data = $this->arionum->getBase58($inputData);
    assertEquals($outputData, $data);
});
