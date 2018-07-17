<?php

namespace pxgamer\Arionum;

/**
 * Class TransactionTest
 */
class TransactionTest extends TestCase
{
    // phpcs:disable Generic.Files.LineLength
    private const TEST_TRANSACTION_ID = '2bAhimfbpzbKuH2E3uFZjK2cBQ9KrUtSvHPXdnGYSqYRE6tYVkLYa9hqTZpyjp6s2ZVoxpWaz5JvgyL8sYjM8Zsq';
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
}
