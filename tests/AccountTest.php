<?php

namespace pxgamer\Arionum;

/**
 * Class AccountTest
 */
class AccountTest extends TestCase
{
    /**
     * @test
     * @throws ApiException
     */
    public function itGeneratesANewAccount()
    {
        $data = $this->arionum->generateAccount();
        $this->assertInstanceOf(\stdClass::class, $data);
        $this->assertObjectHasAttribute('address', $data);
        $this->assertObjectHasAttribute('public_key', $data);
        $this->assertObjectHasAttribute('private_key', $data);
    }

    /**
     * @test
     * @throws ApiException
     */
    public function itGetsTheBalanceForATestAddress()
    {
        $data = $this->arionum->getBalance(self::TEST_ADDRESS);
        $this->assertInternalType('string', $data);
        $this->assertTrue(is_numeric($data));
    }

    /**
     * @test
     * @throws ApiException
     */
    public function itGetsThePendingBalanceForATestAddress()
    {
        $data = $this->arionum->getPendingBalance(self::TEST_ADDRESS);
        $this->assertInternalType('string', $data);
        $this->assertTrue(is_numeric($data));
    }

    /**
     * @test
     * @throws ApiException
     */
    public function itGetsTheTransactionsForATestAddress()
    {
        $data = $this->arionum->getTransactions(self::TEST_ADDRESS);
        $this->assertInternalType('array', $data);
        $this->assertNotEmpty($data);
    }

    /**
     * @test
     * @throws ApiException
     */
    public function itGetsTheTransactionsForATestPublicKey()
    {
        $data = $this->arionum->getTransactionsByPublicKey(self::TEST_PUBLIC_KEY);
        $this->assertInternalType('array', $data);
        $this->assertNotEmpty($data);
    }

    /**
     * @test
     * @throws ApiException
     */
    public function itGetsTheAliasForASpecificAddress()
    {
        $data = $this->arionum->getAlias(self::TEST_ADDRESS);
        $this->assertInternalType('string', $data);
        $this->assertEquals('PXGAMER', $data);
    }

    /**
     * @test
     * @throws ApiException
     */
    public function itChecksThatTheAddressIsValid()
    {
        $data = $this->arionum->checkAddress(self::TEST_ADDRESS);
        $this->assertInternalType('bool', $data);
        $this->assertTrue($data);
    }
}
