<?php 
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 14/10/2016
 * Time: 18:07
 */
class Database {
    public static function getDbConnection()
    {
        require_once 'Constants.php';
        $host = DB_HOST;
        $user = DB_USER;
        $password = DB_PASSWORD;
        $database = DB_NAME;
        return new PDO("mysql:host=$host;dbname=$database", $user, $password);
    }
}