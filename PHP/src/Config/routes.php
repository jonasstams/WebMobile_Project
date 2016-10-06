<?php
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 30/09/2016
 * Time: 14:54
 */
$router = new AltoRouter();
$router->setBasePath('/WebAndMobile/Web_Mobile_Project');
$router->map( 'GET', '/', function() {
    require __DIR__ . '/Views/home.php';
});