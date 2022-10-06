<?php

declare(strict_types=1);

namespace OwenVoke\Arionum\Tests;

use OwenVoke\Arionum\Api\AbstractApi;
use OwenVoke\Arionum\Client;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Http\Client\ClientInterface;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /** @var class-string<AbstractApi> */
    protected string $apiClass;

    protected function getApiMock(): MockObject
    {
        $httpClient = $this->getMockBuilder(ClientInterface::class)
            ->onlyMethods(['sendRequest'])
            ->getMock();

        $httpClient
            ->expects($this->any())
            ->method('sendRequest');

        $client = Client::createWithHttpClient($httpClient);

        return $this->getMockBuilder($this->apiClass)
            ->onlyMethods(['get', 'post', 'postRaw', 'patch', 'delete', 'put', 'head'])
            ->setConstructorArgs([$client])
            ->getMock();
    }
}
