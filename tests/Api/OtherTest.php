<?php

declare(strict_types=1);

use OwenVoke\Arionum\Api\Other;

beforeEach(fn () => $this->apiClass = Other::class);

it('can get a random number', function () {
    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/api.php', [
            'q' => 'randomNumber',
            'height' => 100000,
            'min' => 10,
            'max' => 20,
            'seed' => null,
        ])
        ->willReturn('20');

    /** @var Other $api */
    expect(
        $api->randomNumber(
            height: 100000,
            minimum: 10,
            maximum: 20
        )
    )->toBe(20);
});

it('can get the Base58 encoded version of a string', function () {
    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/api.php', [
            'q' => 'base58',
            'data' => 'Test',
        ])
        ->willReturn('3A836b');

    /** @var Other $api */
    expect(
        $api->base58('Test')
    )->toBe('3A836b');
});

it('can check a signature is valid', function () {
    $api = $this->getApiMock();

    $api->expects($this->once())
        ->method('get')
        ->with('/api.php', [
            'q' => 'checkSignature',
            'signature' => 'AN1rKroKawax5azYrLbasV7VycYAvQXFKrJ69TFYEfmanXwVRrUQTCx5gQ1eVNMgEVzrEz3VzLsfrVVpUYqgB5eT2qsFtaSsw',
            'data' => '1.00000000-0.00250000-PXGAMER--2-PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSCyk7aKeBJ6LL44w5JGSFp82Wb1Drqicuznv1qmRVQMvbmF64AeczjMtV72acGLR9RsiQ2JccemNrSPkKi8KDk72t4-1533911370',
            'public_key' => 'PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSCyk7aKeBJ6LL44w5JGSFp82Wb1Drqicuznv1qmRVQMvbmF64AeczjMtV72acGLR9RsiQ2JccemNrSPkKi8KDk72t4',
        ])
        ->willReturn('true');

    /** @var Other $api */
    expect(
        $api->checkSignature(
            signature: 'AN1rKroKawax5azYrLbasV7VycYAvQXFKrJ69TFYEfmanXwVRrUQTCx5gQ1eVNMgEVzrEz3VzLsfrVVpUYqgB5eT2qsFtaSsw',
            data: '1.00000000-0.00250000-PXGAMER--2-PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSCyk7aKeBJ6LL44w5JGSFp82Wb1Drqicuznv1qmRVQMvbmF64AeczjMtV72acGLR9RsiQ2JccemNrSPkKi8KDk72t4-1533911370',
            publicKey: 'PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSCyk7aKeBJ6LL44w5JGSFp82Wb1Drqicuznv1qmRVQMvbmF64AeczjMtV72acGLR9RsiQ2JccemNrSPkKi8KDk72t4',
        )
    )->toBe(true);
});
