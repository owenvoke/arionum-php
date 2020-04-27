<?php

namespace OwenVoke\Arionum\Tests\Feature;

use OwenVoke\Arionum\Models\Account;
use OwenVoke\Arionum\Tests\TestCase;

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
