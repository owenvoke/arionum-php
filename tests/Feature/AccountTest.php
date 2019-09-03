<?php

declare(strict_types=1);

namespace pxgamer\Arionum\Tests\Feature;

use pxgamer\Arionum\Tests\TestCase;
use pxgamer\Arionum\Exceptions\GenericApiException;

final class AccountTest extends TestCase
{
    /**
     * @test
     * @return void
     * @throws GenericApiException
     */
    public function itGeneratesANewAccount(): void
    {
        $data = $this->arionum->generateAccount();
        $this->assertStringStartsWith('PZ', $data->getPublicKey());
        $this->assertStringStartsWith('Lz', $data->getPrivateKey());
    }

    /**
     * @test
     * @return void
     * @throws GenericApiException
     */
    public function itGetsTheBalanceForATestAddress(): void
    {
        $data = $this->arionum->getBalance(self::TEST_ADDRESS);
        $this->assertIsNumeric($data);
    }

    /**
     * @test
     * @return void
     * @throws GenericApiException
     */
    public function itGetsTheBalanceForATestAlias(): void
    {
        $data = $this->arionum->getBalanceByAlias('PXGAMER');
        $this->assertIsNumeric($data);
    }

    /**
     * @test
     * @return void
     * @throws GenericApiException
     */
    public function itGetsTheBalanceForATestPublicKey(): void
    {
        $data = $this->arionum->getBalanceByPublicKey(self::TEST_PUBLIC_KEY);
        $this->assertIsNumeric($data);
    }

    /**
     * @test
     * @return void
     * @throws GenericApiException
     */
    public function itGetsThePendingBalanceForATestAddress(): void
    {
        $data = $this->arionum->getPendingBalance(self::TEST_ADDRESS);
        $this->assertIsNumeric($data);
    }

    /**
     * @test
     * @return void
     * @throws GenericApiException
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
     * @throws GenericApiException
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
     * @throws GenericApiException
     */
    public function itGetsTheAliasForASpecificAddress(): void
    {
        $data = $this->arionum->getAlias(self::TEST_ADDRESS);
        $this->assertEquals('PXGAMER', $data);
    }

    /**
     * @test
     * @return void
     * @throws GenericApiException
     */
    public function itChecksThatTheAddressIsValid(): void
    {
        $data = $this->arionum->checkAddress(self::TEST_ADDRESS);
        $this->assertTrue($data);
    }
}
