<?php
/**
 * Azureinfo Class
 */
class Azureinfo
{

    function __construct(){}

    function getHttp($url, $accessToken)
    {
        $httpHeader = array("Authorization: Bearer ".$accessToken);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $httpHeader);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($curl);
        curl_close($curl);
        return json_decode($result);
    }

    function getBasicinfo($accessToken)
    {
        return $this->getHttp("https://api.cmu.ac.th/mis/cmuaccount/prod/v3/me/basicinfo", $accessToken);
    }

    function getPersonalinfo($accessToken)
    {
        return $this->getHttp("https://api.cmu.ac.th/mis/hr/prod/me/v3/personalinfo", $accessToken);
    }

}
?>