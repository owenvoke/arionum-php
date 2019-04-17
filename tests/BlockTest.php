<?php

declare(strict_types=1);

namespace pxgamer\Arionum;

final class BlockTest extends TestCase
{
    // phpcs:disable Generic.Files.LineLength
    private const TEST_BLOCK_ID = 'ceiirEsfXyQh3Tnyp6RuSnRANAxNW7BvVGxDUzKFcBH9yHfPa1Jq2oPGH7P41X6Puwn2ajtydn1aHSPhV8X8Sg2';
    // phpcs:enable

    /**
     * @test
     * @return void
     * @throws ApiException
     */
    public function itGetsTheCurrentBlock(): void
    {
        $data = $this->arionum->getCurrentBlock();
        $this->assertObjectHasAttribute('id', $data);
        $this->assertObjectHasAttribute('signature', $data);
    }

    /**
     * @test
     * @return void
     * @throws ApiException
     */
    public function itGetsABlockByItsHeight(): void
    {
        $data = $this->arionum->getBlock(1);
        $this->assertObjectHasAttribute('id', $data);
        $this->assertObjectHasAttribute('signature', $data);
    }

    /**
     * @test
     * @return void
     * @throws ApiException
     */
    public function itGetsTheTransactionsForASpecificBlock(): void
    {
        $data = $this->arionum->getBlockTransactions(self::TEST_BLOCK_ID);
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
    }
}
