<?php

declare(strict_types=1);

use OwenVoke\Arionum\Api\Node;

beforeEach(fn () => $this->apiClass = Node::class);

it('can get the version of the current node');

it('can get information about the current node');

it('can get the sanity details for the current node');

it('can get a list of masternodes');
