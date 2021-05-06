<?php

declare(strict_types=1);

beforeEach()->withArionum();

it('gets a base58 value for input data', function (): void {
    $inputData = 'dataIsHere';
    $outputData = '6e6WaupsT6FzH2';

    $data = $this->arionum->getBase58($inputData);
    expect($data)->toEqual($outputData);
});
