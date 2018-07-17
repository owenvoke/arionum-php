<?php

namespace pxgamer\Arionum;

/**
 * Class ArionumTest
 */
class ArionumTest extends TestCase
{
    /**
     * @test
     * @expectedException \pxgamer\Arionum\ApiException
     */
    public function itThrowsAnExceptionOnInvalidPublicKey()
    {
        $this->arionum->getAddress('INVALID-PUBLIC-KEY');
    }

    /**
     * @test
     * @throws ApiException
     */
    public function itGetsAnAddressFromAPublicKey()
    {
        $data = $this->arionum->getAddress(self::TEST_PUBLIC_KEY);
        $this->assertInternalType('string', $data);
        $this->assertEquals(self::TEST_ADDRESS, $data);
    }

    /**
     * @test
     * @throws ApiException
     */
    public function itGetsTheBalanceForATestAddress()
    {
        $data = $this->arionum->getBalance(self::TEST_ADDRESS);
        $this->assertInternalType('string', $data);
        $this->assertTrue(is_numeric($data));
    }

    /**
     * @test
     * @throws ApiException
     */
    public function itGetsThePendingBalanceForATestAddress()
    {
        $data = $this->arionum->getPendingBalance(self::TEST_ADDRESS);
        $this->assertInternalType('string', $data);
        $this->assertTrue(is_numeric($data));
    }

    /**
     * @test
     * @throws ApiException
     */
    public function itGetsTheTransactionsForATestAddress()
    {
        $data = $this->arionum->getTransactions(self::TEST_ADDRESS);
        $this->assertInternalType('array', $data);
        $this->assertNotEmpty($data);
    }

    /**
     * @test
     * @throws ApiException
     */
    public function itGetsATransactionByItsId()
    {
        $data = $this->arionum->getTransaction(self::TEST_TRANSACTION_ID);
        $this->assertInstanceOf(\stdClass::class, $data);
        $this->assertObjectHasAttribute('version', $data);
    }

    /**
     * @test
     * @throws ApiException
     */
    public function itGetsThePublicKeyForAnAddress()
    {
        $data = $this->arionum->getPublicKey(self::TEST_ADDRESS);
        $this->assertInternalType('string', $data);
        $this->assertTrue(($data === self::TEST_PUBLIC_KEY || $data === ''));
    }

    /**
     * @test
     * @throws ApiException
     */
    public function itGeneratesANewAccount()
    {
        $data = $this->arionum->generateAccount();
        $this->assertInstanceOf(\stdClass::class, $data);
        $this->assertObjectHasAttribute('address', $data);
        $this->assertObjectHasAttribute('public_key', $data);
        $this->assertObjectHasAttribute('private_key', $data);
    }

    /**
     * @test
     * @throws ApiException
     */
    public function itGetsTheCurrentBlock()
    {
        $data = $this->arionum->getCurrentBlock();
        $this->assertInstanceOf(\stdClass::class, $data);
        $this->assertObjectHasAttribute('id', $data);
        $this->assertObjectHasAttribute('signature', $data);
    }

    /**
     * @test
     * @throws ApiException
     */
    public function itGetsABlockByItsHeight()
    {
        $data = $this->arionum->getBlock(1);
        $this->assertInstanceOf(\stdClass::class, $data);
        $this->assertObjectHasAttribute('id', $data);
        $this->assertObjectHasAttribute('signature', $data);
    }

    /**
     * @test
     * @throws ApiException
     */
    public function itGetsTheTransactionsForASpecificBlock()
    {
        $data = $this->arionum->getBlockTransactions(self::TEST_BLOCK_ID);
        $this->assertInternalType('array', $data);
        $this->assertNotEmpty($data);
    }

    /**
     * @test
     * @throws ApiException
     */
    public function itGetsTheNumberOfTransactionsInTheMempool()
    {
        $data = $this->arionum->getMempoolSize();
        $this->assertInternalType('int', $data);
    }

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
