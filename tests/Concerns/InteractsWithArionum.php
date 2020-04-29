<?php

namespace OwenVoke\Arionum\Tests\Concerns;

use GuzzleHttp\Client;
use OwenVoke\Arionum\Arionum;
use OwenVoke\Arionum\Tests\TestCase;

trait InteractsWithArionum
{
    protected Arionum $arionum;

    public function withArionum(?string $testNode = null, ?Client $client = null): void
    {
        $testNode ??= TestCase::TEST_NODE;

        $this->arionum = new Arionum($testNode, $client);
    }
}
