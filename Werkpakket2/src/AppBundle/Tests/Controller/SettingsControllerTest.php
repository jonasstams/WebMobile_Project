<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SettingsControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/settings');
    }

    public function testChangepassword()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/changePassword');
    }

}
