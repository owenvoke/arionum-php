<?php

namespace pxgamer\Arionum;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Config;
use pxgamer\Arionum\Laravel\ArionumServiceProvider;
use pxgamer\Arionum\Laravel\ArionumFacade as Arionum;
use pxgamer\Arionum\Exceptions\InvalidNodeUriException;

final class LaravelTest extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            ArionumServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app): array
    {
        return [
            'Arionum' => ArionumFacade::class,
        ];
    }

    /** @test */
    public function itCanAccessFacadeMethods(): void
    {
        Config::set('arionum.node-uri', 'https://aro.example.com');

        $this->assertEquals('https://aro.example.com', Arionum::getNodeAddress());
    }

    /** @test */
    public function itThrowsAnExceptionOnInvalidNodeUri(): void
    {
        $this->expectException(InvalidNodeUriException::class);
        $this->expectExceptionMessage('The configured node uri is invalid. A valid `ARIONUM_NODE_URI` variable should be configured in your environment');

        Arionum::getNodeAddress();
    }
}
