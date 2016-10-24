<?php
namespace AppBundle\Service;

/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 17/10/2016
 * Time: 12:00
 */
class APICaller
{
    public function customerOverview()
    {
        $data = $this->apiCall('www.jonasstams.be/api/public/customers');
        return $data;
    }

    public function customerByID($id)
    {
        $data = $this->apiCall('www.jonasstams.be/api/public/customers/' . $id);
        return $data;
    }

    public function reportsByCustomerID($id) {
        $data = $this->apiCall('www.jonasstams.be/api/public/reports/' . $id);
        return $data;
    }

    public function updateHabitsForCustomerByID($id, $habit1, $habit2, $habit3) {
        $params = array(
            "habit1"=> $habit1,
            "habit2"=> $habit2,
            "habit3"=> $habit3,
        );

        $data = $this->apiPUTCall('www.jonasstams.be/api/public/customers/' . $id, $params);
        return $data;
    }

    public function apiCall($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        $data = json_decode($response);
        return $data;
    }

    public function apiPUTCall($url, $params) {
        $ch = curl_init();
        $data_json = json_encode($params);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        return $result;
    }
}