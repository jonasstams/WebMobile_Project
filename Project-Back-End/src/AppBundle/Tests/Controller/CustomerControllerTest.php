<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CustomerControllerTest extends WebTestCase
{
    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/add');
    }

    public function testFind()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'customer/find');
    }

    public function testFindall()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'customer/findAll');
    }

    public function testRemove()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'customer/remove');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'customer/edit');
    }

}
