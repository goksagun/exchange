<?php

namespace AppBundle\Exchange\Adapter;

class ProviderThree extends AbstractProvider implements ProviderInterface
{
    protected $name = 'provider-three';

    protected $url = 'http://missing-url.com';

    /**
     * @param array $data
     * @return array
     */
    public function transform(array $data): array
    {
        return $data;
    }
}