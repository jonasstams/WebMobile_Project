<?php

/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 17/10/2016
 * Time: 16:35
 */
use App\Controllers\HomeController;
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
    public function testOpen404Page()
    {
        $this->homeViewMock->expects($this->once())
            ->method('show404Page');
        $homeController = new HomeController($this->homeViewMock);
        $homeController->open404Page();

    }
}