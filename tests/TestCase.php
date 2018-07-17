<?php

namespace pxgamer\Arionum;

use PHPUnit\Framework\TestCase as BaseTestCase;

/**
 * Class TestCase
 */
class TestCase extends BaseTestCase
{
    // phpcs:disable Generic.Files.LineLength
    protected const TEST_NODE = 'https://aro.pxgamer.xyz';
    protected const TEST_ADDRESS = '51sJ4LbdKzhyGy4zJGqodNLse9n9JsVT2rdeH92w7cf3qQuSDJupvjbUT1UBr7r1SCUAXG97saxn7jt2edKb4v4J';
    protected const TEST_PUBLIC_KEY = 'PZ8Tyr4Nx8MHsRAGMpZmZ6TWY63dXWSCyk7aKeBJ6LL44w5JGSFp82Wb1Drqicuznv1qmRVQMvbmF64AeczjMtV72acGLR9RsiQ2JccemNrSPkKi8KDk72t4';
    protected const TEST_TRANSACTION_ID = '2bAhimfbpzbKuH2E3uFZjK2cBQ9KrUtSvHPXdnGYSqYRE6tYVkLYa9hqTZpyjp6s2ZVoxpWaz5JvgyL8sYjM8Zsq';
    protected const TEST_BLOCK_ID = 'ceiirEsfXyQh3Tnyp6RuSnRANAxNW7BvVGxDUzKFcBH9yHfPa1Jq2oPGH7P41X6Puwn2ajtydn1aHSPhV8X8Sg2';
    // phpcs:enable

    /**
     * @var Arionum
     */
    protected $arionum;

    /**
     *
     */
    public function setUp()
    {
        $this->arionum = new Arionum();
        $this->arionum->setNodeAddress(self::TEST_NODE);
    }
}
