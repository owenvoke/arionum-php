<?php

namespace pxgamer\Arionum;

use GuzzleHttp\Client;

/**
 * Class Arionum
 */
class Arionum
{
    /**
     * The request endpoint for API calls.
     */
    const API_ENDPOINT = '/api.php';

    /**
     * @var string
     */
    private $nodeAddress;
    /**
     * @var Client
     */
    private $client;

    /**
     * @return string
     */
    public function getNodeAddress(): string
    {
        return $this->nodeAddress;
    }

    /**
     * @param string $nodeAddress
     */
    public function setNodeAddress(string $nodeAddress): void
    {
        $this->nodeAddress = $nodeAddress;
    }

    public function getClient()
    {
        if (!$this->client instanceof Client) {
            $this->client = new Client([
                'base_uri' => $this->nodeAddress,
            ]);
        }

        return $this->client;
    }
}
