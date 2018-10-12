<?php

namespace pxgamer\Arionum;

/**
 * Class NodeTest
 */
class NodeTest extends TestCase
{
    /**
     * @test
     */
    public function itGetsTheNodeAddress()
    {
        $data = $this->arionum->getNodeAddress();
        $this->assertEquals(self::TEST_NODE, $data);
    }

    /**
     * @test
     * @throws ApiException
     */
    public function itGetsTheVersionForTheCurrentNode()
    {
        $data = $this->arionum->getNodeVersion();
        $this->assertInternalType('string', $data);
    }

    /**
     * @test
     * @throws ApiException
     */
    public function itGetsTheSanityDetailsForTheCurrentNode()
    {
        $data = $this->arionum->getSanityDetails();
        $this->assertInstanceOf(\stdClass::class, $data);

        $this->assertInternalType('bool', $data->sanity_running);
        $this->assertTrue(is_numeric($data->last_sanity));
        $this->assertInternalType('bool', $data->sanity_sync);
    }

    /**
     * @test
     * @throws ApiException
     */
    public function itGetsTheNodeInfoForTheCurrentNode()
    {
        $data = $this->arionum->getNodeInfo();
        $this->assertInstanceOf(\stdClass::class, $data);

        $this->assertInternalType('string', $data->hostname);
        $this->assertInternalType('string', $data->version);
        $this->assertInternalType('string', $data->dbversion);
        $this->assertInternalType('integer', $data->accounts);
        $this->assertInternalType('integer', $data->transactions);
        $this->assertInternalType('integer', $data->mempool);
        $this->assertInternalType('integer', $data->masternodes);
    }
}
