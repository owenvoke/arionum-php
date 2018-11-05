<?php

namespace pxgamer\Arionum;

/**
 * Class KeyTest
 */
class KeyTest extends TestCase
{
    // phpcs:disable Generic.Files.LineLength
    private const TEST_SIGNATURE = 'AN1rKroKawax5azYrLbasV7VycYAvQXFKrJ69TFYEfmanXwVRrUQTCx5gQ1eVNMgEVzrEz3VzLsfrVVpUYqgB5eT2qsFtaSsw';
    private const TEST_SIGNATURE_COMPONENTS = '1.00000000-0.00250000-PXGAMER--2-'.self::TEST_PUBLIC_KEY.'-1533911370';
    // phpcs:enable

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

    /**
     * @test
     * @throws ApiException
     */
    public function itChecksThatASignatureIsValid()
    {
        $data = $this->arionum->checkSignature(
            self::TEST_SIGNATURE,
            self::TEST_SIGNATURE_COMPONENTS,
            self::TEST_PUBLIC_KEY
        );

        $this->assertTrue($data);
    }

    /**
     * @test
     * @throws ApiException
     */
    public function itChecksThatASignatureIsInvalid()
    {
        $data = $this->arionum->checkSignature(
            self::TEST_SIGNATURE,
            'invalid-string',
            self::TEST_PUBLIC_KEY
        );

        $this->assertFalse($data);
    }
}
