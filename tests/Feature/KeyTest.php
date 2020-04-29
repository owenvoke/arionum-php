<?php

declare(strict_types=1);

use OwenVoke\Arionum\Exceptions\GenericApiException;

beforeEach()->withArionum();

$testAddress = '51sJ4LbdKzhyGy4zJGqodNLse9n9JsVT2rdeH92w7cf3qQuSDJupvjbUT1UBr7r1SCUAXG97saxn7jt2edKb4v4J';
$testPublicKey = 'PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSCyk7aKeBJ6LL44w5JGSFp82Wb1Drqicuznv1qmRVQMvbmF64AeczjMtV72acGLR9RsiQ2JccemNrSPkKi8KDk72t4';
$testSignature = 'AN1rKroKawax5azYrLbasV7VycYAvQXFKrJ69TFYEfmanXwVRrUQTCx5gQ1eVNMgEVzrEz3VzLsfrVVpUYqgB5eT2qsFtaSsw';
$testSignatureComponents = "1.00000000-0.00250000-PXGAMER--2-{$testPublicKey}-1533911370";

it('throws an exception when invalid public key is provided', function (): void {
    $this->arionum->getAddress('INVALID-PUBLIC-KEY');
})->throws(GenericApiException::class);

it('gets an address from a public key', function () use ($testAddress, $testPublicKey): void {
    $data = $this->arionum->getAddress($testPublicKey);
    assertEquals($testAddress, $data);
});

it('gets a public key from an address', function () use ($testAddress, $testPublicKey): void {
    $data = $this->arionum->getPublicKey($testAddress);
    assertTrue($data === $testPublicKey || $data === '');
});

it('checks that the public key signature is valid',
    function () use ($testPublicKey, $testSignature, $testSignatureComponents): void {
        $data = $this->arionum->checkSignature(
            $testSignature,
            $testSignatureComponents,
            $testPublicKey
        );

        $this->assertTrue($data);
    }
);

it('checks that the public key signature is invalid', function () use ($testPublicKey, $testSignature): void {
    $data = $this->arionum->checkSignature(
        $testSignature,
        'invalid-string',
        $testPublicKey
    );

    assertFalse($data);
});
