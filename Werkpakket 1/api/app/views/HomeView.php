<?php
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 17/10/2016
 * Time: 16:37
 */
require_once __DIR__.'/../core/View.php';
class HomeView extends View
{
    public function showHomePage()
    {
        header('Location: http://localhost/api/public/home.html');
    }


}