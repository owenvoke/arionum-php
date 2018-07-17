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
     */
    public function itSetsTheNodeAddress()
    {
        $this->arionum->setNodeAddress(self::TEST_NODE);
        $this->assertEquals(self::TEST_NODE, $this->arionum->getNodeAddress());
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
}
