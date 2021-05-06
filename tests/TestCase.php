<?php

declare(strict_types=1);

namespace OwenVoke\Arionum\Tests;

use OwenVoke\Arionum\Arionum;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    public const TEST_NODE = 'https://node.ariochain.info';
    public const TEST_ADDRESS = '51sJ4LbdKzhyGy4zJGqodNLse9n9JsVT2rdeH92w7cf3qQuSDJupvjbUT1UBr7r1SCUAXG97saxn7jt2edKb4v4J';
    public const TEST_PUBLIC_KEY = 'PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSCyk7aKeBJ6LL44w5JGSFp82Wb1Drqicuznv1qmRVQMvbmF64AeczjMtV72acGLR9RsiQ2JccemNrSPkKi8KDk72t4';

    /** @var Arionum */
    protected $arionum;

    /** @return void */
    public function setUp(): void
    {
        $this->arionum = new Arionum(self::TEST_NODE);
    }
}
