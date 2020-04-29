<?php

use OwenVoke\Arionum\Models\Account;

it('can generate a local account', function (): void {
    $account = Account::make();

    assertStringStartsWith('PZ', $account->getPublicKey());
    assertStringStartsWith('Lz', $account->getPrivateKey());
});

it('can generate a local account via the helper', function (): void {
    $this->withArionum();

    $account = $this->arionum->generateLocalAccount();

    assertStringStartsWith('PZ', $account->getPublicKey());
    assertStringStartsWith('Lz', $account->getPrivateKey());
});
