<?php

declare(strict_types=1);

namespace pxgamer\Arionum\Tests\Feature;

use pxgamer\Arionum\Exceptions\GenericApiException;
use pxgamer\Arionum\Models\Transaction;
use pxgamer\Arionum\Tests\TestCase;
use pxgamer\Arionum\Transaction\Version;

final class OtherTest extends TestCase
{
    // phpcs:disable Generic.Files.LineLength
    private const TEST_SEND_KEY1 = 'PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSD1Hm7fGpQAgh1goGj8G47RmU68i3mP4erGGrJ1LNBzEy4di4jZKA2Z6ee96VxaDMUnzSthyzMSyhqF1DbLwNKPim2';
    private const TEST_SEND_KEY2 = 'Lzhp9LopCDbzk3eSdzuL5f9cR9ng12s6gNonQET3kSLtZU4MbQVreDRFjoWcEdUyeUN3tKwpR4AuakWfT6LeCg4trqQ2YSy2q1pUCJppyPBFW89m3xZKhFgMhJgApkevYxYyn1GPDEpmuSUkYhDfEf68xrGNYAhEc';
    private const TEST_RANDOM_NUMBER = 84;
    // phpcs:enable

    /**
     * This should never have enough funds.
     *
     * @test
     * @return void
     * @throws GenericApiException
     */
    public function itThrowsAnExceptionWhenSendingATransactionFromAnEmptyAccount(): void
    {
        $this->expectException(GenericApiException::class);
        $this->expectExceptionMessage('Not enough funds');

        $transaction = new Transaction();
        $transaction->changeValue(1.0);
        $transaction->changeFee(1.0);
        $transaction->changeDestinationAddress(self::TEST_ADDRESS);
        $transaction->changePublicKey(self::TEST_SEND_KEY1);
        $transaction->changeSignature('');
        $transaction->changePrivateKey(self::TEST_SEND_KEY2);
        $transaction->changeMessage('This should fail.');
        $transaction->changeDate(time());
        $transaction->changeVersion(Version::STANDARD);

        $this->arionum->sendTransaction($transaction);
    }

    /**
     * @test
     * @return void
     * @throws GenericApiException
     */
    public function itGetsARandomlyGeneratedNumber(): void
    {
        $data = $this->arionum->getRandomNumber(1, 1, 100, self::TEST_NODE);
        $this->assertEquals(self::TEST_RANDOM_NUMBER, $data);
    }

    /**
     * @test
     * @return void
     * @throws GenericApiException
     */
    public function itGetsAListOfMasternodes(): void
    {
        $data = $this->arionum->getMasternodes();
        $this->assertNotEmpty($data);
    }
}
