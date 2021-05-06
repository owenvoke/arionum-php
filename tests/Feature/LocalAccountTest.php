<?php

use OwenVoke\Arionum\Models\Account;

it('can generate a local account', function (): void {
    $account = Account::make();

    expect($account->getPublicKey())->toStartWith('PZ');
    expect($account->getPrivateKey())->toStartWith('Lz');
});

it('can generate a local account via the helper', function (): void {
    $this->withArionum();

    $account = $this->arionum->generateLocalAccount();

    expect($account->getPublicKey())->toStartWith('PZ');
    expect($account->getPrivateKey())->toStartWith('Lz');
});
