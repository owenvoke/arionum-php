<?php

declare(strict_types=1);

use OwenVoke\Arionum\Api\Asset;

beforeEach(fn () => $this->apiClass = Asset::class);

it('can get all assets');

it('can get a specific asset');

it('can get the asset balance for an account');

it('can get the asset orders for an address');
