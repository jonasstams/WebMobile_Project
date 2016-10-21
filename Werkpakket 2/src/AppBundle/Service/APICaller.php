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
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $params = array(
            "habit1"=> $habit1,
            "habit2"=> $habit2,
            "habit3"=> $habit3,
        );
        $data = json_encode($params);
        $this->debug_to_console($data);
        curl_setopt($ch,CURLOPT_URL,"www.jonasstams.be/api/public/customers/" . $id);
        curl_setopt($ch,CURLOPT_PUT,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($data));
        $result = curl_exec($ch);
        return $result;
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

    function debug_to_console( $data ) {
        if ( is_array( $data ) )
            $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
        else
            $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

        echo $output;
    }
}