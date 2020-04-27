<?php

namespace OwenVoke\Arionum\Tests\Feature;

use OwenVoke\Arionum\Exceptions\SignatureException;
use OwenVoke\Arionum\Helpers\EllipticCurve;
use OwenVoke\Arionum\Models\Transaction;
use OwenVoke\Arionum\Tests\TestCase;

final class EllipticCurveTest extends TestCase
{
    protected const TEST_PUBLIC_KEY = 'PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSD1A2mEcXXCtruh98hrXyaeDZjb1bVQkKUYoEhW3TAJdAVvdCya99DqyeyBa8kBLoJQRriAguY4voHfWrQak8gnySA';
    protected const TEST_PRIVATE_KEY = 'Lzhp9LopCNY4o9DV7Gwobbrb9j1nf9npfYLQN82UcB216dR24wJuytEvNg2obfJJJrjM4ystTnXiF2uU6TDrxA6PgRyRDsUaAgZrp6b5XAfeCLSqhzqmZN9tmNMWPHC6yvLbTd3od42avYZYjAV3r2zg8uWhHhQgS';

    /** @test */
    public function itCanSignDataUsingAPrivateKey(): void
    {
        $signature = EllipticCurve::sign('test-data', self::TEST_PRIVATE_KEY);
        $verified = EllipticCurve::verify('test-data', $signature, self::TEST_PUBLIC_KEY);

        $this->assertTrue($verified);
    }

    /** @test */
    public function itCanGenerateASignatureForATransaction(): void
    {
        $data = new Transaction();

        $data->changePublicKey(self::TEST_PUBLIC_KEY);
        $data->changeValue(1);
        $data->changeFee(1);
        $data->changeDestinationAddress('pxgamer');
        $data->changeMessage('');
        $data->changeDate(time());

        $signatureData = sprintf(
            '%s-%s-%s-%s-%s-%s-%s',
            $data->getValue(),
            $data->getFee(),
            $data->getDestinationAddress(),
            $data->getMessage(),
            $data->getVersion(),
            $data->getPublicKey(),
            $data->getDate()
        );

        $data->sign(self::TEST_PRIVATE_KEY);

        $this->assertTrue(EllipticCurve::verify($signatureData, $data->getSignature(), self::TEST_PUBLIC_KEY));
    }

    /** @test */
    public function itThrowsAnExceptionOnAnInvalidPrivateKey(): void
    {
        $data = new Transaction();

        $data->changePublicKey(self::TEST_PUBLIC_KEY);
        $data->changeValue(1);
        $data->changeFee(1);
        $data->changeDestinationAddress('pxgamer');
        $data->changeMessage('');
        $data->changeDate(time());

        $this->expectException(SignatureException::class);

        $data->sign('');
    }
}
