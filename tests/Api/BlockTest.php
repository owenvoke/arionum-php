<?php

declare(strict_types=1);

use OwenVoke\Arionum\Api\Asset;

beforeEach(fn () => $this->apiClass = Asset::class);

it('can get the current block');

it('can get a specific block by its height');

it('can get the transactions for a block');
