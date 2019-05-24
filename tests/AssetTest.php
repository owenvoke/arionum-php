<?php

namespace pxgamer\Arionum;

use GuzzleHttp\Psr7\Response;
use BlastCloud\Guzzler\UsesGuzzler;

final class AssetTest extends TestCase
{
    use UsesGuzzler;

    public function setUp(): void
    {
        $client = $this->guzzler->getClient();

        $this->arionum = new Arionum(self::TEST_NODE, $client);
    }

    /**
     * @test
     * @return void
     * @throws ApiException
     */
    public function itCanRetrieveAnAssetBalance(): void
    {
        $this->guzzler->expects($this->once())
            ->get(Arionum::API_ENDPOINT)
            ->willRespond(new Response(200, [], '{"data": [], "status": "ok"}'));

        $data = $this->arionum->getAssetBalance(self::TEST_ADDRESS);
        $this->assertIsArray($data);
        $this->assertEmpty($data);
    }
}
