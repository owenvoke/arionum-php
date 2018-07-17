<?php

namespace pxgamer\Arionum;

/**
 * Class BlockTest
 */
class BlockTest extends TestCase
{
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
}
