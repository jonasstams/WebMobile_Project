<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 11/7/16
 * Time: 6:06 PM
 */

namespace Tests\AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CustomerTest extends WebTestCase
{
    protected $client;

    public function setUp()
    {
        $this->client = $this->createClient();
    }

    public function testIndex()
    {
        $crawler = $this->client->request('GET', '/login_admin_test_customer_route');


        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertEquals('Customer Overview', $crawler->filter('h1')->first()->text());

        $this->assertEquals('Jonas', $crawler->filter('td')->eq(1)->text());
    }

    public function testAddCustomerPage()
    {
        $crawler = $this->client->request('GET', '/login_admin_test_customer_route');


        $link = $crawler->filter('a:contains("Add")')->first()->link();
        $customerPage = $this->client->click($link);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertEquals('Create new customer', $customerPage->filter('h1')->first()->text());
    }

    public function testEditCustomerPage()
    {
        $crawler = $this->client->request('GET', '/login_admin_test_customer_route');


        $link = $crawler->filter('a#edit_customer_1')->first()->link();
        $customerPage = $this->client->click($link);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertEquals('Edit customer: Jonas Stams', $customerPage->filter('h1')->first()->text());
    }





}