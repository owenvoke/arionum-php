<?php

namespace pxgamer\Arionum;

use PHPUnit\Framework\TestCase;

/**
 * Class ArionumTest
 *
 * @coversDefaultClass \pxgamer\Arionum\Arionum
 */
class ArionumTest extends TestCase
{
    // phpcs:disable Generic.Files.LineLength
    public const TEST_NODE = 'https://aro.pxgamer.xyz';
    public const TEST_ADDRESS = '51sJ4LbdKzhyGy4zJGqodNLse9n9JsVT2rdeH92w7cf3qQuSDJupvjbUT1UBr7r1SCUAXG97saxn7jt2edKb4v4J';
    public const TEST_PUBLIC_KEY = 'PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSCyk7aKeBJ6LL44w5JGSFp82Wb1Drqicuznv1qmRVQMvbmF64AeczjMtV72acGLR9RsiQ2JccemNrSPkKi8KDk72t4';
    public const TEST_TRANSACTION_ID = '2bAhimfbpzbKuH2E3uFZjK2cBQ9KrUtSvHPXdnGYSqYRE6tYVkLYa9hqTZpyjp6s2ZVoxpWaz5JvgyL8sYjM8Zsq';
    public const TEST_BLOCK_ID = 'ceiirEsfXyQh3Tnyp6RuSnRANAxNW7BvVGxDUzKFcBH9yHfPa1Jq2oPGH7P41X6Puwn2ajtydn1aHSPhV8X8Sg2';
    public const TEST_RANDOM_NUMBER = 84;
    public const TEST_SEND_KEY1 = 'PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSD1Hm7fGpQAgh1goGj8G47RmU68i3mP4erGGrJ1LNBzEy4di4jZKA2Z6ee96VxaDMUnzSthyzMSyhqF1DbLwNKPim2';
    public const TEST_SEND_KEY2 = 'Lzhp9LopCDbzk3eSdzuL5f9cR9ng12s6gNonQET3kSLtZU4MbQVreDRFjoWcEdUyeUN3tKwpR4AuakWfT6LeCg4trqQ2YSy2q1pUCJppyPBFW89m3xZKhFgMhJgApkevYxYyn1GPDEpmuSUkYhDfEf68xrGNYAhEc';
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
     */
    public function testGetNodeAddress()
    {
        $data = $this->arionum->getNodeAddress();
        $this->assertEquals(self::TEST_NODE, $data);
    }

    /**
     *
     */
    public function testSetNodeAddress()
    {
        $this->arionum->setNodeAddress(self::TEST_NODE);
        $this->assertEquals(self::TEST_NODE, $this->arionum->getNodeAddress());
    }

    /**
     * @throws ApiException
     */
    public function testThrowsExceptionOnInvalidPublicKey()
    {
        $this->expectException(ApiException::class);
        $this->arionum->getAddress('INVALID-PUBLIC-KEY');
    }

    /**
     * @throws ApiException
     */
    public function testGetAddress()
    {
        $data = $this->arionum->getAddress(self::TEST_PUBLIC_KEY);
        $this->assertInternalType('string', $data);
        $this->assertEquals(self::TEST_ADDRESS, $data);
    }

    /**
     * @throws ApiException
     */
    public function testGetBase58()
    {
        $data = $this->arionum->getBase58('dataIsHere');
        $this->assertInternalType('string', $data);
        $this->assertEquals('6e6WaupsT6FzH2', $data);
    }

    /**
     * @throws ApiException
     */
    public function testGetBalance()
    {
        $data = $this->arionum->getBalance(self::TEST_ADDRESS);
        $this->assertInternalType('string', $data);
        $this->assertTrue(is_numeric($data));
    }

    /**
     * @throws ApiException
     */
    public function testGetPendingBalance()
    {
        $data = $this->arionum->getPendingBalance(self::TEST_ADDRESS);
        $this->assertInternalType('string', $data);
        $this->assertTrue(is_numeric($data));
    }

    /**
     * @throws ApiException
     */
    public function testGetTransactions()
    {
        $data = $this->arionum->getTransactions(self::TEST_ADDRESS);
        $this->assertInternalType('array', $data);
        $this->assertNotEmpty($data);
    }

    /**
     * @throws ApiException
     */
    public function testGetTransaction()
    {
        $data = $this->arionum->getTransaction(self::TEST_TRANSACTION_ID);
        $this->assertInstanceOf(\stdClass::class, $data);
        $this->assertObjectHasAttribute('version', $data);
    }

    /**
     * @throws ApiException
     */
    public function testGetPublicKey()
    {
        $data = $this->arionum->getPublicKey(self::TEST_ADDRESS);
        $this->assertInternalType('string', $data);
        $this->assertTrue(($data === self::TEST_PUBLIC_KEY || $data === ''));
    }

    /**
     * @throws ApiException
     */
    public function testGenerateAccount()
    {
        $data = $this->arionum->generateAccount();
        $this->assertInstanceOf(\stdClass::class, $data);
        $this->assertObjectHasAttribute('address', $data);
        $this->assertObjectHasAttribute('public_key', $data);
        $this->assertObjectHasAttribute('private_key', $data);
    }

    /**
     * @throws ApiException
     */
    public function testGetCurrentBlock()
    {
        $data = $this->arionum->getCurrentBlock();
        $this->assertInstanceOf(\stdClass::class, $data);
        $this->assertObjectHasAttribute('id', $data);
        $this->assertObjectHasAttribute('signature', $data);
    }

    /**
     * @throws ApiException
     */
    public function testGetBlock()
    {
        $data = $this->arionum->getBlock(1);
        $this->assertInstanceOf(\stdClass::class, $data);
        $this->assertObjectHasAttribute('id', $data);
        $this->assertObjectHasAttribute('signature', $data);
    }

    /**
     * @throws ApiException
     */
    public function testGetBlockTransactions()
    {
        $data = $this->arionum->getBlockTransactions(self::TEST_BLOCK_ID);
        $this->assertInternalType('array', $data);
        $this->assertNotEmpty($data);
    }

    /**
     * @throws ApiException
     */
    public function testGetNodeVersion()
    {
        $data = $this->arionum->getNodeVersion();
        $this->assertInternalType('string', $data);
    }

    /**
     * @throws ApiException
     */
    public function testGetMempoolSize()
    {
        $data = $this->arionum->getMempoolSize();
        $this->assertInternalType('int', $data);
    }

    /**
     * This should never have enough funds.
     *
     * @throws ApiException
     */
    public function testSendTransaction()
    {
        $this->expectException(ApiException::class);
        $this->expectExceptionMessage('Not enough funds');

        $transaction = new Transaction();
        $transaction->setValue(1.0);
        $transaction->setDestinationAddress(self::TEST_ADDRESS);
        // phpcs:disable Generic.Files.LineLength
        $transaction->setPublicKey(self::TEST_SEND_KEY1);
        $transaction->setPrivateKey(self::TEST_SEND_KEY2);
        // phpcs:enable
        $transaction->setMessage('This should fail.');

        $this->arionum->sendTransaction($transaction);
    }

    /**
     * @throws ApiException
     */
    public function testGetRandomNumber()
    {
        $data = $this->arionum->getRandomNumber(1, 1, 100, self::TEST_NODE);
        $this->assertInternalType('int', $data);
        $this->assertEquals(self::TEST_RANDOM_NUMBER, $data);
    }
}
