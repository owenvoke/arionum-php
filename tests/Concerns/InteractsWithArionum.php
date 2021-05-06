<?php

namespace OwenVoke\Arionum\Tests\Concerns;

use OwenVoke\Arionum\Arionum;
use OwenVoke\Arionum\Tests\TestCase;

trait InteractsWithArionum
{
    protected Arionum $arionum;

    public function withArionum(string $testNode = TestCase::TEST_NODE): void
    {
        $this->arionum = new Arionum($testNode);
    }
}
