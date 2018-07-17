<?php

namespace pxgamer\Arionum;

/**
 * Class Base58Test
 */
class Base58Test extends TestCase
{
    private const INPUT_DATA = 'dataIsHere';
    private const OUTPUT_DATA = '6e6WaupsT6FzH2';

    /**
     * @test
     * @throws ApiException
     */
    public function itGetsABase58ValueForInputData()
    {
        $data = $this->arionum->getBase58(self::INPUT_DATA);
        $this->assertInternalType('string', $data);
        $this->assertEquals(self::OUTPUT_DATA, $data);
    }
}
