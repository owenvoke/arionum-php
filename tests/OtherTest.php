<?php

declare(strict_types=1);

namespace pxgamer\Arionum;

/**
 * Class OtherTest
 */
class OtherTest extends TestCase
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
     * @throws ApiException
     */
    public function itThrowsAnExceptionWhenSendingATransactionFromAnEmptyAccount(): void
    {
        $this->expectException(ApiException::class);
        $this->expectExceptionMessage('Not enough funds');

        $transaction = new Transaction();
        $transaction->setValue(1.0);
        $transaction->setFee(1.0);
        $transaction->setDestinationAddress(self::TEST_ADDRESS);
        $transaction->setPublicKey(self::TEST_SEND_KEY1);
        $transaction->setSignature('');
        $transaction->setPrivateKey(self::TEST_SEND_KEY2);
        $transaction->setMessage('This should fail.');
        $transaction->setDate(time());
        $transaction->setVersion(1);

        $this->arionum->sendTransaction($transaction);
    }

    /**
     * @test
     * @return void
     * @throws ApiException
     */
    public function itGetsARandomlyGeneratedNumber(): void
    {
        $data = $this->arionum->getRandomNumber(1, 1, 100, self::TEST_NODE);
        $this->assertEquals(self::TEST_RANDOM_NUMBER, $data);
    }

    /**
     * @test
     * @return void
     * @throws ApiException
     */
    public function itGetsAListOfMasternodes(): void
    {
        $data = $this->arionum->getMasternodes();
        $this->assertNotEmpty($data);
    }
}
