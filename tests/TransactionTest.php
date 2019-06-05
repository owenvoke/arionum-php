<?php

declare(strict_types=1);

namespace pxgamer\Arionum;

use pxgamer\Arionum\Models\Transaction;
use pxgamer\Arionum\Transaction\Version;
use pxgamer\Arionum\Exceptions\GenericApiException;
use pxgamer\Arionum\Transaction\TransactionFactory;

final class TransactionTest extends TestCase
{
    // phpcs:disable Generic.Files.LineLength
    private const TEST_TRANSACTION_ID = '2bAhimfbpzbKuH2E3uFZjK2cBQ9KrUtSvHPXdnGYSqYRE6tYVkLYa9hqTZpyjp6s2ZVoxpWaz5JvgyL8sYjM8Zsq';
    private const TEST_ALIAS = 'pxgamer';
    private const TEST_IP = '127.0.0.1';
    // phpcs:enable

    /**
     * @test
     * @return void
     * @throws GenericApiException
     */
    public function itGetsATransactionByItsId(): void
    {
        $data = $this->arionum->getTransaction(self::TEST_TRANSACTION_ID);
        $this->assertObjectHasAttribute('version', $data);
    }

    /**
     * @test
     * @return void
     * @throws GenericApiException
     */
    public function itGetsTheNumberOfTransactionsInTheMempool(): void
    {
        $data = $this->arionum->getMempoolSize();
        $this->assertNotEmpty($data);
    }

    /** @test */
    public function itCanGenerateAnAliasSendTransaction(): void
    {
        $data = TransactionFactory::makeAliasSendInstance(self::TEST_ALIAS, 1.0);
        $this->assertEquals(self::TEST_ALIAS, $data->getDestinationAddress());
        $this->assertEquals(1.0, $data->getValue());
        $this->assertEquals(Version::ALIAS_SEND, $data->getVersion());
    }

    /** @test */
    public function itCanGenerateAnAliasSetTransaction(): void
    {
        $data = TransactionFactory::makeAliasSetInstance(self::TEST_ADDRESS, self::TEST_ALIAS);
        $this->assertEquals(self::TEST_ADDRESS, $data->getDestinationAddress());
        $this->assertEquals(self::TEST_ALIAS, $data->getMessage());
        $this->assertEquals(Version::ALIAS_SET, $data->getVersion());
        $this->assertEquals(Transaction::VALUE_ALIAS_SET, $data->getValue());
    }

    /** @test */
    public function itCanGenerateAMasternodeCreateTransaction(): void
    {
        $data = TransactionFactory::makeMasternodeCreateInstance(self::TEST_IP, self::TEST_ADDRESS);
        $this->assertEquals(self::TEST_ADDRESS, $data->getDestinationAddress());
        $this->assertEquals(self::TEST_IP, $data->getMessage());
        $this->assertEquals(Version::MASTERNODE_CREATE, $data->getVersion());
        $this->assertEquals(Transaction::VALUE_MASTERNODE_CREATE, $data->getValue());
        $this->assertEquals(Transaction::FEE_MASTERNODE_CREATE, $data->getFee());
    }

    /** @test */
    public function itCanGenerateAMasternodePauseTransaction(): void
    {
        $data = TransactionFactory::makeMasternodePauseInstance(self::TEST_ADDRESS);
        $this->assertEquals(self::TEST_ADDRESS, $data->getDestinationAddress());
        $this->assertEquals(Version::MASTERNODE_PAUSE, $data->getVersion());
        $this->assertEquals(Transaction::VALUE_MASTERNODE_COMMAND, $data->getValue());
        $this->assertEquals(Transaction::FEE_MASTERNODE_COMMAND, $data->getFee());
    }

    /** @test */
    public function itCanGenerateAMasternodeResumeTransaction(): void
    {
        $data = TransactionFactory::makeMasternodeResumeInstance(self::TEST_ADDRESS);
        $this->assertEquals(self::TEST_ADDRESS, $data->getDestinationAddress());
        $this->assertEquals(Version::MASTERNODE_RESUME, $data->getVersion());
        $this->assertEquals(Transaction::VALUE_MASTERNODE_COMMAND, $data->getValue());
        $this->assertEquals(Transaction::FEE_MASTERNODE_COMMAND, $data->getFee());
    }

    /** @test */
    public function itCanGenerateAMasternodeReleaseTransaction(): void
    {
        $data = TransactionFactory::makeMasternodeReleaseInstance(self::TEST_ADDRESS);
        $this->assertEquals(self::TEST_ADDRESS, $data->getDestinationAddress());
        $this->assertEquals(Version::MASTERNODE_RELEASE, $data->getVersion());
        $this->assertEquals(Transaction::VALUE_MASTERNODE_COMMAND, $data->getValue());
        $this->assertEquals(Transaction::FEE_MASTERNODE_COMMAND, $data->getFee());
    }
}
