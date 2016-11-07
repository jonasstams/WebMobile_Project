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
        return json_encode($data['data']);
    }

    public function showJson($json) {
        header('Content-Type: application/json');
        return $json;
    }

    public function sendReponse($responseCode = 200){
        http_response_code($responseCode);
    }

    public function sendOkReponse(){
        $this->sendReponse();
    }


    public function sendCreatedReponse(){
        $this->sendReponse(201);
    }

    public function sendAcceptedReponse(){
        $this->sendReponse(202);
    }

    public function sendNoContentReponse(){
        $this->sendReponse(204);
    }

    public function sendNotModifiedResponse(){
        $this->sendResponse(304);
    }

     public function sendBadRequestResponse(){
        $this->sendResponse(400);
    }
     public function sendNotFoundResponse(){
        $this->sendResponse(404);
    }
}
