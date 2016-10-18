<?php
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 16/10/2016
 * Time: 14:14
 */
class View
{
    public function show($data = null){
        header('Content-Type: application/json');
        echo $this->encodeJson($data);

    }

    private function encodeJson($data) {
        return json_encode($data['data']);
    }

    public function showJson($json) {
        header('Content-Type: application/json');
        return $json;
    }
}