<?php

declare(strict_types=1);

namespace pxgamer\Arionum\Tests;

use pxgamer\Arionum\Exceptions\GenericApiException;

final class Base58Test extends TestCase
{
    private const INPUT_DATA = 'dataIsHere';
    private const OUTPUT_DATA = '6e6WaupsT6FzH2';

    /**
     * @test
     * @return void
     * @throws GenericApiException
     */
    public function itGetsABase58ValueForInputData(): void
    {
        $data = $this->arionum->getBase58(self::INPUT_DATA);
        $this->assertEquals(self::OUTPUT_DATA, $data);
    }
}
