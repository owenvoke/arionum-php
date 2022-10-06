<?php

declare(strict_types=1);

namespace OwenVoke\Arionum\Api;

use OwenVoke\Arionum\Client;
use OwenVoke\Arionum\HttpClient\Message\ResponseMediator;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractApi
{
    protected const API_PATH = '/api.php';

    public function __construct(private readonly Client $client)
    {
    }

    protected function getClient(): Client
    {
        return $this->client;
    }

    public function configure(): self
    {
        return $this;
    }

    /**
     * Send a GET request with query parameters.
     *
     * @param  string  $path           Request path.
     * @param  array<string, mixed>  $parameters     GET parameters.
     * @param  array<string, mixed>  $requestHeaders Request Headers.
     * @return array<string|int, mixed>|string
     */
    protected function get(string $path, array $parameters = [], array $requestHeaders = []): array|string
    {
        if (count($parameters) > 0) {
            $path .= '?'.http_build_query($parameters, '', '&', PHP_QUERY_RFC3986);
        }

        $response = $this->client->getHttpClient()->get($path, $requestHeaders);

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a HEAD request with query parameters.
     *
     * @param  string  $path           Request path.
     * @param  array<string, mixed>  $parameters     HEAD parameters.
     * @param  array<string, mixed>  $requestHeaders Request headers.
     * @return ResponseInterface
     */
    protected function head(string $path, array $parameters = [], array $requestHeaders = []): ResponseInterface
    {
        return $this->client->getHttpClient()->head(
            $path.'?'.http_build_query($parameters, '', '&', PHP_QUERY_RFC3986),
            $requestHeaders
        );
    }

    /**
     * Send a POST request with JSON-encoded parameters.
     *
     * @param  string  $path           Request path.
     * @param  array<string, mixed>  $parameters     POST parameters to be JSON encoded.
     * @param  array<string, mixed>  $requestHeaders Request headers.
     * @return array<string|int, mixed>|string
     */
    protected function post(string $path, array $parameters = [], array $requestHeaders = []): array|string
    {
        return $this->postRaw(
            $path,
            $this->createJsonBody($parameters),
            $requestHeaders
        );
    }

    /**
     * Send a POST request with raw data.
     *
     * @param  string  $path           Request path.
     * @param  string|null  $body           Request body.
     * @param  array<string, mixed>  $requestHeaders Request headers.
     * @return array<string|int, mixed>|string
     */
    protected function postRaw(string $path, string|null $body, array $requestHeaders = []): array|string
    {
        $response = $this->client->getHttpClient()->post(
            $path,
            $requestHeaders,
            $body
        );

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a PATCH request with JSON-encoded parameters.
     *
     * @param  string  $path           Request path.
     * @param  array<string, mixed>  $parameters     POST parameters to be JSON encoded.
     * @param  array<string, mixed>  $requestHeaders Request headers.
     * @return array<string|int, mixed>|string
     */
    protected function patch(string $path, array $parameters = [], array $requestHeaders = []): array|string
    {
        $response = $this->client->getHttpClient()->patch(
            $path,
            $requestHeaders,
            $this->createJsonBody($parameters)
        );

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a PUT request with JSON-encoded parameters.
     *
     * @param  string  $path           Request path.
     * @param  array<string, mixed>  $parameters     POST parameters to be JSON encoded.
     * @param  array<string, mixed>  $requestHeaders Request headers.
     * @return array<string|int, mixed>|string
     */
    protected function put(string $path, array $parameters = [], array $requestHeaders = []): array|string
    {
        $response = $this->client->getHttpClient()->put(
            $path,
            $requestHeaders,
            $this->createJsonBody($parameters)
        );

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a DELETE request with JSON-encoded parameters.
     *
     * @param  string  $path           Request path.
     * @param  array<string, mixed>  $parameters     POST parameters to be JSON encoded.
     * @param  array<string, mixed>  $requestHeaders Request headers.
     * @return array<string|int, mixed>|string
     */
    protected function delete(string $path, array $parameters = [], array $requestHeaders = []): array|string
    {
        $response = $this->client->getHttpClient()->delete(
            $path,
            $requestHeaders,
            $this->createJsonBody($parameters)
        );

        return ResponseMediator::getContent($response);
    }

    /**
     * Create a JSON encoded version of an array of parameters.
     *
     * @param  array<string, mixed>  $parameters Request parameters
     * @return string|null
     */
    protected function createJsonBody(array $parameters): string|null
    {
        return (count($parameters) === 0) ? null : (json_encode($parameters) ?: null);
    }
}
