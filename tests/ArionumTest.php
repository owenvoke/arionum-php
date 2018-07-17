<?php

namespace pxgamer\Arionum;

/**
 * Class ArionumTest
 */
class ArionumTest extends TestCase
{
    /**
     * This should never have enough funds.
     *
     * @test
     * @expectedException \pxgamer\Arionum\ApiException
     * @expectedExceptionMessage Not enough funds
     */
    public function itThrowsAnExceptionWhenSendingATransactionFromAnEmptyAccount()
    {
        $transaction = new Transaction();
        $transaction->setValue(1.0);
        $transaction->setDestinationAddress(self::TEST_ADDRESS);
        // phpcs:disable Generic.Files.LineLength
        $transaction->setPublicKey(self::TEST_SEND_KEY1);
        $transaction->setSignature('');
        $transaction->setPrivateKey(self::TEST_SEND_KEY2);
        // phpcs:enable
        $transaction->setMessage('This should fail.');
        $transaction->setDate(time());
        $transaction->setVersion(1);

        $this->arionum->sendTransaction($transaction);
    }

    /**
     * @test
     * @throws ApiException
     */
    public function itGetsARandomlyGeneratedNumber()
    {
        $data = $this->arionum->getRandomNumber(1, 1, 100, self::TEST_NODE);
        $this->assertInternalType('int', $data);
        $this->assertEquals(self::TEST_RANDOM_NUMBER, $data);
    }
}
