<?php
/**
 * Created by PhpStorm.
 * User: Gebruiker
 * Date: 25/10/2016
 * Time: 11:25
 */

namespace Tests\AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class postControllerTest extends WebTestCase
{

   /*
    public function testShowPost()
    {
        $method = 'GET';
        $uri = 'http://localhost:8000/coach/';
        $parameters = array();
        $files = array();
        $server = array();
        $content = array();
        $client = static::createClient();
        $client->request($method, $uri, $parameters, $files, $server, $content);
        $response = $client->getResponse();
        $this->assertEquals(Response::HTTP_FOUND, $response->getStatusCode());
    }

    public function testCustomerAdd(){
        $method = 'POST';
        $uri = 'http://www.jonasstams.be/api/public/customers';
        $parameters = array();
        $files = array();
        $server = array();
        $content = json_encode(array('first_name'=>'Erik', 'last_name'=>'Van Deurzen' ,'habit1'=>'lopen', 'habit2'=>'zwemmen', 'habit3'=>'programmeren'));
        $client = static::createClient();
        $client->request($method, $uri, $parameters, $files, $server, $content);
        $response = $client->getResponse();
        $response = $client->getResponse();
        $statusCode = $response->getStatusCode();
        $this->assertEquals(Response::HTTP_CREATED, $statusCode);
    }

    public function testCustomerAdd2(){
        $client=static::createClient();
        $crawler=$client->request('GET', 'localhost:8000/coach');
        $link=$crawler->filter('a:contains("overview")')->eq(1)->link();
        $crawler = $client->click($link);
        $this->assertGreaterThan(0, $crawler->filter('')
          }

*/
    public function testCustomerEdit(){
        $method = 'GET';
        $uri = 'api/public/customers/';
        $parameters = array();
        $files = array();
        $server = array();
        $content=array();
       // $content = array('first_name'=>'Erik', 'last_name'=>'Van Deurzen' ,'habit1'=>'lopen', 'habit2'=>'zwemmen', 'habit3'=>'programmeren');
        $client = static::createClient(array('HTTP_HOST'=>'http://www.jonasstams.be/'));
       // var_dump($content);
        $client->request($method, $uri, $parameters, $files, $server, $content);
        $response = $client->getResponse();
        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
    }


}