<?php

declare(strict_types=1);

namespace OwenVoke\Arionum;

use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\RedirectPlugin;
use Http\Discovery\Psr17FactoryDiscovery;
use OwenVoke\Arionum\Api\AbstractApi;
use OwenVoke\Arionum\Enums\Node;
use OwenVoke\Arionum\Exception\BadMethodCallException;
use OwenVoke\Arionum\Exception\InvalidArgumentException;
use OwenVoke\Arionum\HttpClient\Builder;
use Psr\Http\Client\ClientInterface;

/**
 * @method Api\Account account()
 * @method Api\Account accounts()
 * @method Api\Account address()
 * @method Api\Account addresses()
 * @method Api\Node node()
 * @method Api\Node nodes()
 * @method Api\Other other()
 * @method Api\Other misc()
 * @method Api\Other miscellaneous()
 */
final class Client
{
    public function __construct(private ?string $nodeUri = null, private Builder|null $httpClientBuilder = null)
    {
        $this->httpClientBuilder = $builder = $httpClientBuilder ?? new Builder();

        $builder->addPlugin(new RedirectPlugin());
        $builder->addPlugin(new AddHostPlugin(Psr17FactoryDiscovery::findUriFactory()->createUri(
            Node::providedOrRandom($this->nodeUri)
        )));
        $builder->addPlugin(new HeaderDefaultsPlugin([
            'User-Agent' => 'arionum-php (https://github.com/owenvoke/arionum-php)',
        ]));

        $builder->addHeaderValue('Accept', 'application/json');
    }

    public static function createWithHttpClient(ClientInterface $httpClient): self
    {
        $builder = new Builder($httpClient);

        return new self(httpClientBuilder: $builder);
    }

    /** @throws InvalidArgumentException */
    public function api(string $name): AbstractApi
    {
        return match ($name) {
            'account', 'accounts', 'address', 'addresses' => new Api\Account($this),
            'asset', 'assets' => new Api\Asset($this),
            'node', 'nodes' => new Api\Node($this),
            'other', 'misc', 'miscellaneous' => new Api\Other($this),
            'transaction', 'transactions' => new Api\Transaction($this),
            default => throw new InvalidArgumentException(sprintf('Undefined api instance called: "%s"', $name)),
        };
    }

    private function setNodeUri(string $uri): void
    {
        $this->nodeUri = $uri;

        $builder = $this->getHttpClientBuilder();
        $builder->removePlugin(AddHostPlugin::class);

        $builder->addPlugin(new AddHostPlugin(Psr17FactoryDiscovery::findUriFactory()->createUri($this->getNodeUri())));
    }

    public function getNodeUri(): ?string
    {
        return $this->nodeUri;
    }

    public function __call(string $name, array $args): AbstractApi
    {
        try {
            return $this->api($name);
        } catch (InvalidArgumentException $e) {
            throw new BadMethodCallException(sprintf('Undefined method called: "%s"', $name), $e->getCode(), $e);
        }
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->getHttpClientBuilder()->getHttpClient();
    }

    protected function getHttpClientBuilder(): Builder
    {
        return $this->httpClientBuilder;
    }
}
