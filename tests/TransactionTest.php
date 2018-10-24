<?php

namespace pxgamer\Arionum;

/**
 * Class TransactionTest
 */
class TransactionTest extends TestCase
{
    // phpcs:disable Generic.Files.LineLength
    private const TEST_TRANSACTION_ID = '2bAhimfbpzbKuH2E3uFZjK2cBQ9KrUtSvHPXdnGYSqYRE6tYVkLYa9hqTZpyjp6s2ZVoxpWaz5JvgyL8sYjM8Zsq';
    private const TEST_ALIAS = 'pxgamer';
    private const TEST_IP = '127.0.0.1';
    // phpcs:enable

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
    public function itGetsTheNumberOfTransactionsInTheMempool()
    {
        $data = $this->arionum->getMempoolSize();
        $this->assertInternalType('int', $data);
    }

    /**
     * @test
     */
    public function itCanGenerateAnAliasSendTransaction()
    {
        $data = Transaction::makeAliasSendInstance(self::TEST_ALIAS, 1.0);
        $this->assertInstanceOf(Transaction::class, $data);
        $this->assertEquals(self::TEST_ALIAS, $data->dst);
        $this->assertEquals(1.0, $data->val);
        $this->assertEquals(Transaction::VERSION_ALIAS_SEND, $data->version);
    }

    /**
     * @test
     */
    public function itCanGenerateAnAliasSetTransaction()
    {
        $data = Transaction::makeAliasSetInstance(self::TEST_ADDRESS, self::TEST_ALIAS);
        $this->assertInstanceOf(Transaction::class, $data);
        $this->assertEquals(self::TEST_ADDRESS, $data->dst);
        $this->assertEquals(self::TEST_ALIAS, $data->message);
        $this->assertEquals(Transaction::VERSION_ALIAS_SET, $data->version);
        $this->assertEquals(Transaction::VALUE_ALIAS_SET, $data->val);
    }

    /**
     * @test
     */
    public function itCanGenerateAnMasternodeCreateTransaction()
    {
        $data = Transaction::makeMasternodeCreateInstance(self::TEST_IP, self::TEST_ADDRESS);
        $this->assertInstanceOf(Transaction::class, $data);
        $this->assertEquals(self::TEST_ADDRESS, $data->dst);
        $this->assertEquals(self::TEST_IP, $data->message);
        $this->assertEquals(Transaction::VERSION_MASTERNODE_CREATE, $data->version);
        $this->assertEquals(Transaction::VALUE_MASTERNODE_CREATE, $data->val);
        $this->assertEquals(Transaction::FEE_MASTERNODE_CREATE, $data->fee);
    }

    /**
     * @test
     */
    public function itCanGenerateAnMasternodePauseTransaction()
    {
        $data = Transaction::makeMasternodePauseInstance(self::TEST_ADDRESS);
        $this->assertInstanceOf(Transaction::class, $data);
        $this->assertEquals(self::TEST_ADDRESS, $data->dst);
        $this->assertEquals(Transaction::VERSION_MASTERNODE_PAUSE, $data->version);
        $this->assertEquals(Transaction::VALUE_MASTERNODE_COMMAND, $data->val);
        $this->assertEquals(Transaction::FEE_MASTERNODE_COMMAND, $data->fee);
    }

    /**
     * @test
     */
    public function itCanGenerateAnMasternodeResumeTransaction()
    {
        $data = Transaction::makeMasternodeResumeInstance(self::TEST_ADDRESS);
        $this->assertInstanceOf(Transaction::class, $data);
        $this->assertEquals(self::TEST_ADDRESS, $data->dst);
        $this->assertEquals(Transaction::VERSION_MASTERNODE_RESUME, $data->version);
        $this->assertEquals(Transaction::VALUE_MASTERNODE_COMMAND, $data->val);
        $this->assertEquals(Transaction::FEE_MASTERNODE_COMMAND, $data->fee);
    }

    /**
     * @test
     */
    public function itCanGenerateAnMasternodeReleaseTransaction()
    {
        $data = Transaction::makeMasternodeReleaseInstance(self::TEST_ADDRESS);
        $this->assertInstanceOf(Transaction::class, $data);
        $this->assertEquals(self::TEST_ADDRESS, $data->dst);
        $this->assertEquals(Transaction::VERSION_MASTERNODE_RELEASE, $data->version);
        $this->assertEquals(Transaction::VALUE_MASTERNODE_COMMAND, $data->val);
        $this->assertEquals(Transaction::FEE_MASTERNODE_COMMAND, $data->fee);
    }
}
