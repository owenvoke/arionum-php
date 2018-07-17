<?php

namespace pxgamer\Arionum;

/**
 * Class KeyTest
 */
class KeyTest extends TestCase
{
    /**
     * @test
     * @expectedException \pxgamer\Arionum\ApiException
     */
    public function itThrowsAnExceptionOnInvalidPublicKey()
    {
        $this->arionum->getAddress('INVALID-PUBLIC-KEY');
    }

    /**
     * @test
     * @throws ApiException
     */
    public function itGetsAnAddressFromAPublicKey()
    {
        $data = $this->arionum->getAddress(self::TEST_PUBLIC_KEY);
        $this->assertInternalType('string', $data);
        $this->assertEquals(self::TEST_ADDRESS, $data);
    }

    /**
     * @test
     * @throws ApiException
     */
    public function itGetsThePublicKeyForAnAddress()
    {
        $data = $this->arionum->getPublicKey(self::TEST_ADDRESS);
        $this->assertInternalType('string', $data);
        $this->assertTrue(($data === self::TEST_PUBLIC_KEY || $data === ''));
    }
}
