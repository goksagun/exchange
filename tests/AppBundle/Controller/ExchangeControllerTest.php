<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ExchangeControllerTest extends WebTestCase
{
    public function testShowExchangeList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('Exchange Rate', $crawler->filter('h3')->text());
    }
}