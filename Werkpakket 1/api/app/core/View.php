<?php
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 16/10/2016
 * Time: 14:14
 */
class View
{
    public function show($data){
		header('Content-Type: application/json');
        echo $this->encodeJson($data);
    }

    private function encodeJson($data) {
        if(isset($data['data']))
            return json_encode($data['data']);
        else
            return json_encode($data);
    }

    public function showJson($json) {
        header('Content-Type: application/json');
        return $json;
    }

    public function sendResponse($responseCode = 200){
        http_response_code($responseCode);
    }

    public function sendError($errors = []){
        header('Content-Type: application/json');
        return $this->encodeJson($errors);
    }

    public function sendOkReponse(){
        $this->sendResponse();
    }


    public function sendHttpCreated(){
        $this->sendResponse(201);
    }

    public function sendHttpAccepted(){
        $this->sendResponse(202);
    }

    public function sendHttpNoContent(){
        $this->sendResponse(204);
    }

    public function sendHttpNotModified(){
        $this->sendResponse(304);
    }

     public function sendHttpBadRequest($error = '{}'){
        $this->sendResponse(400);        
        $this->show($error);
    }
     public function sendHttpNotFound(){
        $this->sendResponse(404);
    }
}