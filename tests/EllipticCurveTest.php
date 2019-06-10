<?php

namespace pxgamer\Arionum;

use pxgamer\Arionum\Helpers\EllipticCurve;

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
}
