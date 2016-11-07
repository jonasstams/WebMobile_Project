<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 11/7/16
 * Time: 4:36 PM
 */

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
class AdminTest extends WebTestCase
{
    protected $client;
    protected function setUp()
    {
        $this->client = static::createClient();

    }

    public function testAdminPage(){

        $crawler = $this->client->request('GET', '/login_admin_test_route');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Welcome to the Admin page")')->count()
        );


    }
    public function testSettingsPage(){

        $crawler = $this->client->request('GET', '/login_admin_test_route');


        $link = $crawler->filter('a:contains("Settings")')->first()->link();
        $otherPage = $this->client->click($link);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertEquals('Change password', $otherPage->filter('h1')->first()->text());
    }

    public function testCustomerOverviewPage(){
        $crawler = $this->client->request('GET', '/login_admin_test_route');


        $link = $crawler->filter('a:contains("Manage Coaches")')->first()->link();
        $customerPage = $this->client->click($link);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertEquals('Coach list', $customerPage->filter('h1')->first()->text());
    }


    public function testLogout(){
        $crawler = $this->client->request('GET', '/login_admin_test_route');


        $link = $crawler->filter('a:contains("Yes")')->first()->link();
        $customerPage = $this->client->click($link);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertEquals('Welcome to Lifestyle', $customerPage->filter('h1')->first()->text());
    }
  

}