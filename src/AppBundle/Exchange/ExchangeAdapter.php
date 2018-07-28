<?php

namespace AppBundle\Exchange;

use AppBundle\Exchange\Adapter\ProviderInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;

class ExchangeAdapter implements ExchangeAdapterInterface
{
    /**
     * @var ProviderInterface
     */
    private $provider;

    /**
     * ExchangeAdapter constructor.
     * @param ProviderInterface $provider
     */
    public function __construct(ProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Fetches exchange information client
     *
     * @return array
     */
    public function fetch(): array
    {
        $client = new \GuzzleHttp\Client();

        $url = $this->provider->getUrl();

        if (empty($url)) {
            throw new \InvalidArgumentException('Provider "url" must be specified.');
        }

        try {
            $response = $client->get($url);

            $result = $response->getBody();
        } catch (ClientException | RequestException $e) {
            // TODO: handle exception, log, mail etc...
            return [];
        }

        $result = json_decode($result, true);

        return $this->provider->transform($result);
    }

    /**
     * @return ProviderInterface
     */
    public function getProvider(): ProviderInterface
    {
        return $this->provider;
    }

    /**
     * @param ProviderInterface $provider
     */
    public function setProvider(ProviderInterface $provider): void
    {
        $this->provider = $provider;
    }
}