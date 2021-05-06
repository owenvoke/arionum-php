<?php

namespace OwenVoke\Arionum\Tests\Feature;

use OwenVoke\Arionum\Exceptions\SignatureException;
use OwenVoke\Arionum\Helpers\EllipticCurve;
use OwenVoke\Arionum\Models\Transaction;

beforeEach(function () {
    $this->testPublicKey = 'PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSD1A2mEcXXCtruh98hrXyaeDZjb1bVQkKUYoEhW3TAJdAVvdCya99DqyeyBa8kBLoJQRriAguY4voHfWrQak8gnySA';
    $this->testPrivateKey = 'Lzhp9LopCNY4o9DV7Gwobbrb9j1nf9npfYLQN82UcB216dR24wJuytEvNg2obfJJJrjM4ystTnXiF2uU6TDrxA6PgRyRDsUaAgZrp6b5XAfeCLSqhzqmZN9tmNMWPHC6yvLbTd3od42avYZYjAV3r2zg8uWhHhQgS';
});

it('CanSignDataUsingAPrivateKey', function (): void {
    $signature = EllipticCurve::sign('test-data', $this->testPrivateKey);
    $verified = EllipticCurve::verify('test-data', $signature, $this->testPublicKey);

    expect($verified)->toBeTrue();
});

it('CanGenerateASignatureForATransaction', function (): void {
    $data = new Transaction();

    $data->changePublicKey($this->testPublicKey);
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

    $data->sign($this->testPrivateKey);

    expect(EllipticCurve::verify($signatureData, $data->getSignature(), $this->testPublicKey))->toBeTrue();
});

it('throws an exception on an invalid private key', function (): void {
    $data = new Transaction();

    $data->changePublicKey($this->testPublicKey);
    $data->changeValue(1);
    $data->changeFee(1);
    $data->changeDestinationAddress('pxgamer');
    $data->changeMessage('');
    $data->changeDate(time());

    $data->sign('');
})->throws(SignatureException::class);
