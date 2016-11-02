<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CustomerControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/customer/');
    }

    public function testCustomer()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/customer');
    }

    public function testCustomerreportoverview()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'customer/reports');
    }

    public function testCustomerhabitsoverview()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'customer/habits');
    }

    public function testUpdatecustomerhabits()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/customer/customerUpdated');
    }

}
