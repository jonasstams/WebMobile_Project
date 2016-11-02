<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CoachControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/coach/');
    }

    public function testCustomer()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/coach/customer');
    }

}
