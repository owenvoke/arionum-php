<?php

declare(strict_types=1);

namespace pxgamer\Arionum;

/**
 * Class NodeTest
 */
class NodeTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function itGetsTheNodeAddress(): void
    {
        $data = $this->arionum->getNodeAddress();
        $this->assertEquals(self::TEST_NODE, $data);
    }

    /**
     * @test
     * @return void
     * @throws ApiException
     */
    public function itGetsTheVersionForTheCurrentNode(): void
    {
        $data = $this->arionum->getNodeVersion();
        $this->assertNotEmpty($data);
    }

    /**
     * @test
     * @return void
     * @throws ApiException
     */
    public function itGetsTheSanityDetailsForTheCurrentNode(): void
    {
        $data = $this->arionum->getSanityDetails();

        $this->assertInternalType('bool', $data->sanity_running);
        $this->assertInternalType('numeric', $data->last_sanity);
        $this->assertInternalType('bool', $data->sanity_sync);
    }

    /**
     * @test
     * @return void
     * @throws ApiException
     */
    public function itGetsTheNodeInfoForTheCurrentNode(): void
    {
        $data = $this->arionum->getNodeInfo();

        $this->assertInternalType('string', $data->hostname);
        $this->assertInternalType('string', $data->version);
        $this->assertInternalType('string', $data->dbversion);
        $this->assertInternalType('integer', $data->accounts);
        $this->assertInternalType('integer', $data->transactions);
        $this->assertInternalType('integer', $data->mempool);
        $this->assertInternalType('integer', $data->masternodes);
    }
}
