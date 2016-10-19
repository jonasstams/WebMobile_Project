<?php

/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 17/10/2016
 * Time: 16:35
 */
require_once __DIR__.'/../controllers/HomeController.php';
class HomeControllerTest extends PHPUnit_Framework_TestCase
{
    protected $homeViewMock;

    public function setUp()
    {
        $this->homeViewMock = $this->getMockBuilder(HomeView::class)
            ->getMock();
    }

    public function testOpenHomePage()
    {
        $this->homeViewMock->expects($this->once())
            ->method('showHomePage');
        $homeController = new HomeController($this->homeViewMock);
        $homeController->openHomePage();

    }
}