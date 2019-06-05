<?php

declare(strict_types=1);

namespace pxgamer\Arionum;

use pxgamer\Arionum\Exceptions\GenericApiException;

final class KeyTest extends TestCase
{
    // phpcs:disable Generic.Files.LineLength
    private const TEST_SIGNATURE = 'AN1rKroKawax5azYrLbasV7VycYAvQXFKrJ69TFYEfmanXwVRrUQTCx5gQ1eVNMgEVzrEz3VzLsfrVVpUYqgB5eT2qsFtaSsw';
    private const TEST_SIGNATURE_COMPONENTS = '1.00000000-0.00250000-PXGAMER--2-'.self::TEST_PUBLIC_KEY.'-1533911370';
    // phpcs:enable

    /**
     * @test
     * @return void
     * @throws GenericApiException
     */
    public function itThrowsAnExceptionOnInvalidPublicKey(): void
    {
        $this->expectException(GenericApiException::class);

        $this->arionum->getAddress('INVALID-PUBLIC-KEY');
    }

    /**
     * @test
     * @return void
     * @throws GenericApiException
     */
    public function itGetsAnAddressFromAPublicKey(): void
    {
        $data = $this->arionum->getAddress(self::TEST_PUBLIC_KEY);
        $this->assertEquals(self::TEST_ADDRESS, $data);
    }

    /**
     * @test
     * @return void
     * @throws GenericApiException
     */
    public function itGetsThePublicKeyForAnAddress(): void
    {
        $data = $this->arionum->getPublicKey(self::TEST_ADDRESS);
        $this->assertTrue($data === self::TEST_PUBLIC_KEY || $data === '');
    }

    /**
     * @test
     * @return void
     * @throws GenericApiException
     */
    public function itChecksThatASignatureIsValid(): void
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
     * @return void
     * @throws GenericApiException
     */
    public function itChecksThatASignatureIsInvalid(): void
    {
        $data = $this->arionum->checkSignature(
            self::TEST_SIGNATURE,
            'invalid-string',
            self::TEST_PUBLIC_KEY
        );

        $this->assertFalse($data);
    }
}
