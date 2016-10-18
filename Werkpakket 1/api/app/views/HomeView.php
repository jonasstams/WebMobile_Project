<?php

/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 17/10/2016
 * Time: 16:37
 */
class HomeView extends View
{
    public function showHomePage()
    {
        header('Location: http://localhost/api/public/home.html');
    }

    public function show404Page()
    {
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
        header('Location: http://localhost/api/public/404.html');
    }

}