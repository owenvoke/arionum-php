<?php

declare(strict_types=1);

namespace pxgamer\Arionum;

class Base58Test extends TestCase
{
    private const INPUT_DATA = 'dataIsHere';
    private const OUTPUT_DATA = '6e6WaupsT6FzH2';

    /**
     * @test
     * @return void
     * @throws ApiException
     */
    public function itGetsABase58ValueForInputData(): void
    {
        $data = $this->arionum->getBase58(self::INPUT_DATA);
        $this->assertEquals(self::OUTPUT_DATA, $data);
    }
}
