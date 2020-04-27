<?php

declare(strict_types=1);

namespace pxgamer\Arionum\Tests\Feature;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use pxgamer\Arionum\Arionum;
use pxgamer\Arionum\Exceptions\GenericApiException;
use pxgamer\Arionum\Tests\TestCase;

final class NodeTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function itGetsTheNodeAddress(): void
    {
        $data = $this->arionum->getNodeAddress();
        $this->assertEquals(self::TEST_NODE, $data);
    }

    /**
     * @test
     * @return void
     * @throws GenericApiException
     */
    public function itGetsTheVersionForTheCurrentNode(): void
    {
        $data = $this->arionum->getNodeVersion();
        $this->assertNotEmpty($data);
    }

    /**
     * @test
     * @return void
     * @throws GenericApiException
     */
    public function itGetsTheSanityDetailsForTheCurrentNode(): void
    {
        $data = $this->arionum->getSanityDetails();

        $this->assertIsBool($data->sanity_running);
        $this->assertIsNumeric($data->last_sanity);
        $this->assertIsBool($data->sanity_sync);
    }

    /**
     * @test
     * @return void
     * @throws GenericApiException
     */
    public function itGetsTheNodeInfoForTheCurrentNode(): void
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                'status' => 'ok',
                'data' => [
                    'hostname' => 'https://aro.example.com',
                    'version' => '0.4.5',
                    'dbversion' => '9',
                    'accounts' => 14817,
                    'transactions' => 2779519,
                    'mempool' => 8,
                    'masternodes' => 484,
                    'peers' => 108,
                ],
                'coin' => 'arionum',
            ])),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $this->arionum = new Arionum(self::TEST_NODE, $client);

        $data = $this->arionum->getNodeInfo();

        $this->assertIsString($data->hostname);
        $this->assertIsString($data->version);
        $this->assertIsString($data->dbversion);
        $this->assertIsInt($data->accounts);
        $this->assertIsInt($data->transactions);
        $this->assertIsInt($data->mempool);
        $this->assertIsInt($data->masternodes);

        $this->assertEquals('https://aro.example.com', $data->hostname);
    }
}
