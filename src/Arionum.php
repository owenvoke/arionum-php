<?php

declare(strict_types=1);

namespace pxgamer\Arionum;

use pxgamer\Arionum\Adapter\HttpAdapter;
use pxgamer\Arionum\Api\Node;

final class Arionum
{
    /** @var HttpAdapter */
    private $adapter;

    public function __construct(HttpAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function node(): Node
    {
        return new Node($this->adapter);
    }
}
