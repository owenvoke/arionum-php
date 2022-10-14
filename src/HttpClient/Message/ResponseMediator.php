<?php

namespace OwenVoke\Arionum\HttpClient\Message;

use OwenVoke\Arionum\Exception\RuntimeException;
use Psr\Http\Message\ResponseInterface;

final class ResponseMediator
{
    /** @return array<string|int, mixed>|string */
    public static function getContent(ResponseInterface $response): array|string
    {
        $body = $response->getBody()->__toString();
        if (str_starts_with($response->getHeaderLine('Content-Type'), 'application/json')) {
            $content = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
            if (JSON_ERROR_NONE === json_last_error()) {
                return $content['data'] ?? throw new RuntimeException('Error: Field "data" was not set', $content);
            }
        }

        return $body;
    }

    public static function getHeader(ResponseInterface $response, string $name): string|null
    {
        $headers = $response->getHeader($name);

        return array_shift($headers);
    }
}
