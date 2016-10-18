<?php

/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 8/10/2016
 * Time: 17:45
 */
require_once __DIR__.'/../views/HomeView.php';
class HomeController extends Controller
{
    protected $view;
    public function __construct(View $view = null)
    {
        if($view == null)
            $this->view = new HomeView();
        else
            $this->view = $view;
    }

    public function openHomePage()
    {
        $this->view->showHomePage();
    }

    public function open404Page()
    {
        $this->view->show404Page();
    }
}