<?php

declare(strict_types=1);

use OwenVoke\Arionum\Api\Other;

beforeEach(fn () => $this->apiClass = Other::class);

it('can get a random number');

it('can get the Base58 encoded version of a string');

it('can check a signature is valid');
