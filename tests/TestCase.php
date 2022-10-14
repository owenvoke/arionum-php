<?php

declare(strict_types=1);

namespace OwenVoke\Arionum\Tests;

use Http\Client\Plugin\Vcr\NamingStrategy\PathNamingStrategy;
use Http\Client\Plugin\Vcr\Recorder\FilesystemRecorder;
use Http\Client\Plugin\Vcr\RecordPlugin;
use Http\Client\Plugin\Vcr\ReplayPlugin;
use OwenVoke\Arionum\Api\AbstractApi;
use OwenVoke\Arionum\Client;
use OwenVoke\Arionum\HttpClient\Builder;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /** @var class-string<AbstractApi> */
    protected string $apiClass;

    protected function getApiMock(): AbstractApi
    {
        $namingStrategy = new PathNamingStrategy();
        $recorder = new FilesystemRecorder(__DIR__.'/__SNAPSHOTS__');

        $httpBuilder = new Builder();
        $httpBuilder->addPlugin(
            in_array('--update-snapshots', $_SERVER['argv']) || getenv('UPDATE_SNAPSHOTS') === 'true' ?
                new RecordPlugin($namingStrategy, $recorder) :
                new ReplayPlugin($namingStrategy, $recorder)
        );

        $client = new Client(null, $httpBuilder);

        return new ($this->apiClass)($client);
    }
}
