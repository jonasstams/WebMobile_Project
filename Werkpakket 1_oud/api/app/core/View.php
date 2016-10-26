<?php
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 16/10/2016
 * Time: 14:14
 */
class View
{
    public function show($data = null, $statusCode = 200){
        $this->returnStatusCode($statusCode);
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

    public function sendHttpNotFound()
    {
        $this->returnStatusCode(404);
    }

    public function sendHttpNoContent()
    {
        $this->returnStatusCode(204);
    }

    public function sendHttpCreated(){
        $this->returnStatusCode(201);
    }

    public function sendHttpAccepted(){
        $this->returnStatusCode(202);
    }

    public function sendHttpBadRequest(){
        $this->returnStatusCode(400);
    }
    private function returnStatusCode($statusCode = 404){
        http_response_code($statusCode);
    }
}