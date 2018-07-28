<?php

namespace AppBundle\Exchange;

use AppBundle\Exchange\Adapter\ProviderInterface;

interface ExchangeAdapterInterface
{
    /**
     * Fetches exchange information client
     *
     * @return array
     */
    public function fetch(): array;

    /**
     * Get provider
     *
     * @return ProviderInterface
     */
    public function getProvider(): ProviderInterface;
}