<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 11/7/16
 * Time: 4:36 PM
 */

namespace Tests\AppBundle\Controller;

use AppBundle\Controller\CoachController;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
class CoachTest extends WebTestCase
{
    protected $client;
    protected function setUp()
    {
        $this->client = static::createClient();

    }

    public function testAdminPage(){

        $crawler = $this->client->request('GET', '/login_coach_test_route');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Welcome to the Coach page")')->count()
        );


    }
    public function testSettingsPage(){

        $crawler = $this->client->request('GET', '/login_coach_test_route');


        $link = $crawler->filter('a:contains("Settings")')->first()->link();
        $otherPage = $this->client->click($link);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertEquals('Change password', $otherPage->filter('h1')->first()->text());
    }

    public function testCustomerOverviewPage(){
        $crawler = $this->client->request('GET', '/login_coach_test_route');


        $link = $crawler->filter('a:contains("Customer overview")')->first()->link();
        $customerPage = $this->client->click($link);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertEquals('Customer Overview', $customerPage->filter('h1')->first()->text());

    }

    public function testLogout(){
        $crawler = $this->client->request('GET', '/login_coach_test_route');


        $link = $crawler->filter('a:contains("Yes")')->first()->link();
        $customerPage = $this->client->click($link);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertEquals('Welcome to Lifestyle', $customerPage->filter('h1')->first()->text());
    }

}