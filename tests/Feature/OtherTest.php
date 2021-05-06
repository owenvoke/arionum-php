<?php

declare(strict_types=1);

use OwenVoke\Arionum\Arionum;
use OwenVoke\Arionum\Exceptions\GenericApiException;
use OwenVoke\Arionum\Models\Transaction;
use OwenVoke\Arionum\Tests\TestCase;
use OwenVoke\Arionum\Transaction\Version;

beforeEach(function (): void {
    $this->arionum = new Arionum(TestCase::TEST_NODE);
});

/** This should never have enough funds. */
it('throws an exception when sending a transaction from an empty account', function (): void {
    $testSendPublicKey = 'PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSD1Hm7fGpQAgh1goGj8G47RmU68i3mP4erGGrJ1LNBzEy4di4jZKA2Z6ee96VxaDMUnzSthyzMSyhqF1DbLwNKPim2';
    $testSendPrivateKey = 'Lzhp9LopCDbzk3eSdzuL5f9cR9ng12s6gNonQET3kSLtZU4MbQVreDRFjoWcEdUyeUN3tKwpR4AuakWfT6LeCg4trqQ2YSy2q1pUCJppyPBFW89m3xZKhFgMhJgApkevYxYyn1GPDEpmuSUkYhDfEf68xrGNYAhEc';

    $transaction = new Transaction();
    $transaction->changeValue(1.0);
    $transaction->changeFee(1.0);
    $transaction->changeDestinationAddress(TestCase::TEST_ADDRESS);
    $transaction->changePublicKey($testSendPublicKey);
    $transaction->changeSignature('');
    $transaction->changePrivateKey($testSendPrivateKey);
    $transaction->changeMessage('This should fail.');
    $transaction->changeDate(time());
    $transaction->changeVersion(Version::STANDARD);

    $this->arionum->sendTransaction($transaction);
})->throws(GenericApiException::class, 'Not enough funds');

it('gets a randomly generated number', function (): void {
    $testRandomNumber = 75;

    $data = $this->arionum->getRandomNumber(1, 1, 100, TestCase::TEST_NODE);
    expect($data)->toEqual($testRandomNumber);
});

it('gets a list of masternodes', function (): void {
    $data = $this->arionum->getMasternodes();
    expect($data)->not->toBeEmpty();
});
