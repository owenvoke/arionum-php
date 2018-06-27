<?php

namespace pxgamer\Arionum;

use PHPUnit\Framework\TestCase;

/**
 * Class ArionumTest
 */
class ArionumTest extends TestCase
{
    const TEST_NODE = 'https://aro.pxgamer.xyz';
    const TEST_ADDRESS = '51sJ4LbdKzhyGy4zJGqodNLse9n9JsVT2rdeH92w7cf3qQuSDJupvjbUT1UBr7r1SCUAXG97saxn7jt2edKb4v4J';
    // phpcs:disable Generic.Files.LineLength
    const TEST_PUBLIC_KEY = 'PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSCyk7aKeBJ6LL44w5JGSFp82Wb1Drqicuznv1qmRVQMvbmF64AeczjMtV72acGLR9RsiQ2JccemNrSPkKi8KDk72t4';
    // phpcs:enable

    /**
     * @var Arionum
     */
    private $arionum;

    /**
     *
     */
    public function setUp()
    {
        $this->arionum = new Arionum();
        $this->arionum->setNodeAddress(self::TEST_NODE);
    }

    /**
     *
     * @throws ApiException
     */
    public function testGetAddress()
    {
        $data = $this->arionum->getAddress(self::TEST_PUBLIC_KEY);
        $this->assertInternalType('string', $data);
        $this->assertEquals(self::TEST_ADDRESS, $data);
    }

    /**
     *
     * @throws ApiException
     */
    public function testThrowsExceptionOnInvalidPublicKey()
    {
        $this->expectException(ApiException::class);
        $this->arionum->getAddress('INVALID-PUBLIC-KEY');
    }

    /**
     *
     * @throws ApiException
     */
    public function testGetBase58()
    {
        $data = $this->arionum->getBase58('dataIsHere');
        $this->assertInternalType('string', $data);
        $this->assertEquals('6e6WaupsT6FzH2', $data);
    }

    /**
     *
     * @throws ApiException
     */
    public function testGetBalance()
    {
        $data = $this->arionum->getBalance(self::TEST_ADDRESS);
        $this->assertInternalType('string', $data);
        $this->assertTrue(is_numeric($data));
    }
}
