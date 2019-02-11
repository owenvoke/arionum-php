<?php

declare(strict_types=1);

namespace pxgamer\Arionum\Adapter;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;
use pxgamer\Arionum\Exception\HttpException;

class HttpAdapter
{
    /** @var ClientInterface */
    protected $client;

    /** @var Response */
    protected $response;

    public function __construct(string $token, ?ClientInterface $client = null)
    {
        $this->client = $client ?: new Client(['headers' => ['Authorization' => sprintf('Bearer %s', $token)]]);
    }

    /**
     * @param string $url
     * @return string
     */
    public function get(string $url): string
    {
        try {
            $this->response = $this->client->get($url);
        } catch (RequestException $e) {
            $this->response = $e->getResponse();
            $this->handleError();
        }

        return (string)$this->response->getBody();
    }

    /**
     * @param string $url
     * @return string
     */
    public function delete(string $url): string
    {
        try {
            $this->response = $this->client->delete($url);
        } catch (RequestException $e) {
            $this->response = $e->getResponse();
            $this->handleError();
        }

        return (string)$this->response->getBody();
    }

    /**
     * @param string       $url
     * @param array|string $content
     * @return string
     * @throws HttpException
     */
    public function put(string $url, $content = ''): string
    {
        $options = [];

        $options[is_array($content) ? 'json' : 'body'] = $content;

        try {
            $this->response = $this->client->put($url, $options);
        } catch (RequestException $e) {
            $this->response = $e->getResponse();
            $this->handleError();
        }

        return (string)$this->response->getBody();
    }

    /**
     * @param string       $url
     * @param array|string $content
     * @return string
     * @throws HttpException
     */
    public function post(string $url, $content = ''): string
    {
        $options = [];

        $options[is_array($content) ? 'json' : 'body'] = $content;

        try {
            $this->response = $this->client->post($url, $options);
        } catch (RequestException $e) {
            $this->response = $e->getResponse();
            $this->handleError();
        }

        return (string)$this->response->getBody();
    }

    public function getLatestResponseHeaders(): ?array
    {
        if (null === $this->response) {
            return null;
        }

        return [
            'reset' => (int)(string)$this->response->getHeader('RateLimit-Reset'),
            'remaining' => (int)(string)$this->response->getHeader('RateLimit-Remaining'),
            'limit' => (int)(string)$this->response->getHeader('RateLimit-Limit'),
        ];
    }

    /** @throws HttpException */
    protected function handleError(): void
    {
        $body = (string)$this->response->getBody();
        $code = (int)$this->response->getStatusCode();

        $content = json_decode($body);

        throw new HttpException($content->message ?? 'Request not processed.', $code);
    }
}
