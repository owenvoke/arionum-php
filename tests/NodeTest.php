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

        $this->assertIsBool($data->sanity_running);
        $this->assertIsNumeric($data->last_sanity);
        $this->assertIsBool($data->sanity_sync);
    }

    /**
     * @test
     * @return void
     * @throws ApiException
     */
    public function itGetsTheNodeInfoForTheCurrentNode(): void
    {
        $data = $this->arionum->getNodeInfo();

        $this->assertIsString($data->hostname);
        $this->assertIsString($data->version);
        $this->assertIsString($data->dbversion);
        $this->assertIsInt($data->accounts);
        $this->assertIsInt($data->transactions);
        $this->assertIsInt($data->mempool);
        $this->assertIsInt($data->masternodes);
    }
}
