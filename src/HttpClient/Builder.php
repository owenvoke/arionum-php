<?php

namespace OwenVoke\Arionum\HttpClient;

use Http\Client\Common\HttpMethodsClient;
use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\HeaderAppendPlugin;
use Http\Client\Common\PluginClientFactory;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

final class Builder
{
    /** The object that sends HTTP messages. */
    private ClientInterface $httpClient;

    /** An HTTP client with all our plugins. */
    private HttpMethodsClientInterface $pluginClient;

    private RequestFactoryInterface $requestFactory;

    public StreamFactoryInterface $streamFactory;

    /** True if we should create a new Plugin client at next request. */
    private bool $httpClientModified = true;

    /** @var array<int, Plugin> */
    private array $plugins = [];

    /** @var array<string, array<int, int|string>|int|string> */
    private array $headers = [];

    public function __construct(
        ClientInterface $httpClient = null,
        RequestFactoryInterface $requestFactory = null,
        StreamFactoryInterface $streamFactory = null,
    ) {
        $this->httpClient = $httpClient ?? Psr18ClientDiscovery::find();
        $this->requestFactory = $requestFactory ?? Psr17FactoryDiscovery::findRequestFactory();
        $this->streamFactory = $streamFactory ?? Psr17FactoryDiscovery::findStreamFactory();
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        if ($this->httpClientModified) {
            $this->httpClientModified = false;

            $plugins = $this->plugins;

            $this->pluginClient = new HttpMethodsClient(
                (new PluginClientFactory())->createClient($this->httpClient, $plugins),
                $this->requestFactory,
                $this->streamFactory
            );
        }

        return $this->pluginClient;
    }

    public function addPlugin(Plugin $plugin): void
    {
        $this->plugins[] = $plugin;
        $this->httpClientModified = true;
    }

    /** @param  class-string<Plugin>  $className */
    public function removePlugin(string $className): void
    {
        foreach ($this->plugins as $idx => $plugin) {
            if ($plugin instanceof $className) {
                unset($this->plugins[$idx]);
                $this->httpClientModified = true;
            }
        }
    }

    /**
     * Clears used headers.
     */
    public function clearHeaders(): void
    {
        $this->headers = [];

        $this->removePlugin(HeaderAppendPlugin::class);
        $this->addPlugin(new HeaderAppendPlugin($this->headers));
    }

    /**
     * @param  array<string, string|int>  $headers
     */
    public function addHeaders(array $headers): void
    {
        $this->headers = array_merge($this->headers, $headers);

        $this->removePlugin(HeaderAppendPlugin::class);
        $this->addPlugin(new HeaderAppendPlugin($this->headers));
    }

    public function addHeaderValue(string $header, string $headerValue): void
    {
        if (! isset($this->headers[$header])) {
            $this->headers[$header] = $headerValue;
        } else {
            $this->headers[$header] = array_merge((array) $this->headers[$header], [$headerValue]);
        }

        $this->removePlugin(HeaderAppendPlugin::class);
        $this->addPlugin(new HeaderAppendPlugin($this->headers));
    }
}
