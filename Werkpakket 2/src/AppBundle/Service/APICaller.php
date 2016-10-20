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

    public function apiCall($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        $data = json_decode($response);
        return $data;
    }
}