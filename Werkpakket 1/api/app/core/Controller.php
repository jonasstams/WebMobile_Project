<?php

/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 8/10/2016
 * Time: 17:42
 */
class Controller
{
    public function model($model)
    {
        require_once( __DIR__ . '/../models/' . $model . '.php');

        return new $model();
    }
/*
    public function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }
*/

    public function getPostData(){
        $data = file_get_contents('php://input');
        if(!empty($data)){
            return $data;
        }else{
            return null;
        }
    }

    public function decodeJson($postData){
        return json_decode($postData);
    }
}