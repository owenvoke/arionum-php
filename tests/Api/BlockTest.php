<?php

declare(strict_types=1);

use OwenVoke\Arionum\Api\Block;

beforeEach(fn () => $this->apiClass = Block::class);

it('can get the current block');

it('can get a specific block by its height');

it('can get the transactions for a block');
