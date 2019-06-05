<?php

namespace pxgamer\Arionum;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use pxgamer\Arionum\Exceptions\GenericApiException;

final class AssetTest extends TestCase
{
    /**
     * @test
     * @return void
     * @throws GenericApiException
     */
    public function itCanRetrieveAnAssetBalance(): void
    {
        $mock = new MockHandler([
            new Response(200, [], '{"data": [], "status": "ok"}'),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $this->arionum = new Arionum(self::TEST_NODE, $client);

        $data = $this->arionum->getAssetBalance(self::TEST_ADDRESS);
        $this->assertIsArray($data);
        $this->assertEmpty($data);
    }
}
