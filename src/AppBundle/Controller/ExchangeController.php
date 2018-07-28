<?php

namespace AppBundle\Controller;

use AppBundle\Service\ExchangeService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ExchangeController extends Controller
{
    /**
     * @Route("/", methods={"GET"})
     */
    public function indexAction(ExchangeService $service)
    {
        return $this->render(
            '@App/Exchange/index.html.twig',
            [
                'exchanges' => $service->getCheapestExchangeRateList(),
            ]
        );
    }

}
