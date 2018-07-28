<?php

namespace AppBundle\Exchange\Adapter;

class ProviderTwo extends AbstractProvider implements ProviderInterface
{
    const CODE_MAPPING = [
        'DOLAR' => 'USDTRY',
        'AVRO' => 'EURTRY',
        'İNGİLİZ STERLİNİ' => 'GBPTRY',
    ];

    protected $name = 'provider-two';

    protected $url = 'http://www.mocky.io/v2/5a74524e2d0000430bfe0fa3';

    /**
     * @param array $data
     * @return array
     */
    public function transform(array $data): array
    {
        return array_map(
            function ($item) {
                return [
                    'code' => static::CODE_MAPPING[$item['kod']],
                    'rate' => floatval($item['oran']),
                ];
            },
            $data
        );
    }
}