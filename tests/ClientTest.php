<?php

declare(strict_types=1);

use OwenVoke\Arionum\Api\Account;
use OwenVoke\Arionum\Api\Asset;
use OwenVoke\Arionum\Api\Block;
use OwenVoke\Arionum\Api\Node;
use OwenVoke\Arionum\Api\Other;
use OwenVoke\Arionum\Api\Transaction;
use OwenVoke\Arionum\Client;

it('gets instances from the client', function () {
    $client = new Client();

    expect($client)->toBeInstanceOf(Client::class)

        // Retrieves Account instance
        ->and($client->account())->toBeInstanceOf(Account::class)
        ->and($client->accounts())->toBeInstanceOf(Account::class)
        ->and($client->address())->toBeInstanceOf(Account::class)
        ->and($client->addresses())->toBeInstanceOf(Account::class)

        // Retrieves Asset instance
        ->and($client->asset())->toBeInstanceOf(Asset::class)
        ->and($client->assets())->toBeInstanceOf(Asset::class)

        // Retrieves Block instance
        ->and($client->block())->toBeInstanceOf(Block::class)
        ->and($client->blocks())->toBeInstanceOf(Block::class)

        // Retrieves Node instance
        ->and($client->node())->toBeInstanceOf(Node::class)
        ->and($client->nodes())->toBeInstanceOf(Node::class)

        // Retrieves Other instance
        ->and($client->other())->toBeInstanceOf(Other::class)
        ->and($client->misc())->toBeInstanceOf(Other::class)
        ->and($client->miscellaneous())->toBeInstanceOf(Other::class)

        // Retrieves Other instance
        ->and($client->transaction())->toBeInstanceOf(Transaction::class)
        ->and($client->transactions())->toBeInstanceOf(Transaction::class);
});
