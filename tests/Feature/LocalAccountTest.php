<?php

namespace pxgamer\Arionum\Tests\Feature;

use pxgamer\Arionum\Models\Account;
use pxgamer\Arionum\Tests\TestCase;

final class LocalAccountTest extends TestCase
{
    /** @test */
    public function itCanGenerateALocalAccount(): void
    {
        $account = Account::make();

        $this->assertStringStartsWith('PZ', $account->getPublicKey());
        $this->assertStringStartsWith('Lz', $account->getPrivateKey());
    }

    /** @test */
    public function itCanGenerateALocalAccountViaTheHelper(): void
    {
        $account = $this->arionum->generateLocalAccount();

        $this->assertStringStartsWith('PZ', $account->getPublicKey());
        $this->assertStringStartsWith('Lz', $account->getPrivateKey());
    }
}
