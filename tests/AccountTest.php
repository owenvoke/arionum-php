<?php

declare(strict_types=1);

namespace pxgamer\Arionum;

class AccountTest extends TestCase
{
    /**
     * @test
     * @return void
     * @throws ApiException
     */
    public function itGeneratesANewAccount(): void
    {
        $data = $this->arionum->generateAccount();
        $this->assertObjectHasAttribute('address', $data);
        $this->assertObjectHasAttribute('public_key', $data);
        $this->assertObjectHasAttribute('private_key', $data);
    }

    /**
     * @test
     * @return void
     * @throws ApiException
     */
    public function itGetsTheBalanceForATestAddress(): void
    {
        $data = $this->arionum->getBalance(self::TEST_ADDRESS);
        $this->assertIsNumeric($data);
    }

    /**
     * @test
     * @return void
     * @throws ApiException
     */
    public function itGetsTheBalanceForATestAlias(): void
    {
        $data = $this->arionum->getBalanceByAlias('PXGAMER');
        $this->assertIsNumeric($data);
    }

    /**
     * @test
     * @return void
     * @throws ApiException
     */
    public function itGetsTheBalanceForATestPublicKey(): void
    {
        $data = $this->arionum->getBalanceByPublicKey(self::TEST_PUBLIC_KEY);
        $this->assertIsNumeric($data);
    }

    /**
     * @test
     * @return void
     * @throws ApiException
     */
    public function itGetsThePendingBalanceForATestAddress(): void
    {
        $data = $this->arionum->getPendingBalance(self::TEST_ADDRESS);
        $this->assertIsNumeric($data);
    }

    /**
     * @test
     * @return void
     * @throws ApiException
     */
    public function itGetsTheTransactionsForATestAddress(): void
    {
        $data = $this->arionum->getTransactions(self::TEST_ADDRESS);
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
    }

    /**
     * @test
     * @return void
     * @throws ApiException
     */
    public function itGetsTheTransactionsForATestPublicKey(): void
    {
        $data = $this->arionum->getTransactionsByPublicKey(self::TEST_PUBLIC_KEY);
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
    }

    /**
     * @test
     * @return void
     * @throws ApiException
     */
    public function itGetsTheAliasForASpecificAddress(): void
    {
        $data = $this->arionum->getAlias(self::TEST_ADDRESS);
        $this->assertEquals('PXGAMER', $data);
    }

    /**
     * @test
     * @return void
     * @throws ApiException
     */
    public function itChecksThatTheAddressIsValid(): void
    {
        $data = $this->arionum->checkAddress(self::TEST_ADDRESS);
        $this->assertTrue($data);
    }
}
