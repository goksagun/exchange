<?php

namespace AppBundle\Exchange\Adapter;

class ProviderOne extends AbstractProvider implements ProviderInterface
{
    protected $name = 'provider-one';

    protected $url = 'http://www.mocky.io/v2/5a74519d2d0000430bfe0fa0';

    /**
     * @param array $data
     * @return array
     */
    public function transform(array $data): array
    {
        return array_map(
            function ($item) {
                return [
                    'code' => $item['symbol'],
                    'rate' => floatval($item['amount']),
                ];
            },
            $data['result']
        );
    }
}