<?php

namespace AppBundle\Service;

use AppBundle\Entity\Exchange;
use AppBundle\Exchange\ExchangeAdapterInterface;
use Doctrine\ORM\EntityManagerInterface;

class ExchangeService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * ExchangeService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return array
     */
    public function getExchangeRateList()
    {
        return $this->entityManager->getRepository(Exchange::class)->findExchanges();
    }

    /**
     * @return array
     */
    public function getCheapestExchangeRateList()
    {
        return $this->entityManager->getRepository(Exchange::class)->findCheapestExchanges();
    }

    /**
     * @param ExchangeAdapterInterface $adapter
     * @return array
     */
    public function batchProcess(ExchangeAdapterInterface $adapter)
    {
        $result = [];

        foreach ($adapter->fetch() as $data) {
            $providerName = $adapter->getProvider()->getName();

            $result[$providerName] = $this->createOrUpdate($providerName, $data);
        }

        return $result;
    }

    /**
     * @param string $providerName
     * @param array $data
     * @return Exchange
     */
    public function createOrUpdate(string $providerName, array $data)
    {
        $repository = $this->entityManager->getRepository(Exchange::class);

        $exchange = $repository->findOneByProviderAndCode($providerName, $data['code']);

        if ($exchange instanceof Exchange) {
            $exchange->setRate($data['rate']);

            $repository->update($exchange);

            return $exchange;
        }

        $exchange = new Exchange();
        $exchange->setProvider($providerName);
        $exchange->setCode($data['code']);
        $exchange->setRate($data['rate']);

        $repository->insert($exchange);

        return $exchange;
    }
}