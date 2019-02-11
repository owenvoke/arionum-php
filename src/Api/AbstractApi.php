<?php

declare(strict_types=1);

namespace pxgamer\Arionum\Api;

use pxgamer\Arionum\Adapter\HttpAdapter;

abstract class AbstractApi
{
    /** @var string */
    public const ENDPOINT = 'http://peer1.arionum.com';

    /** @var HttpAdapter */
    protected $adapter;

    /** @var string */
    protected $endpoint;

    public function __construct(HttpAdapter $adapter, ?string $endpoint = null)
    {
        $this->adapter = $adapter;
        $this->endpoint = $endpoint ?: static::ENDPOINT;
    }
}
