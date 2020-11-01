<?php
require "ResponseParser.php";

class WebClient
{

    function __construct() {}

    function getInfo($url) {
        $response = $this->getWebPage($url);

        $responseParser = new ResponseParser($response);

        return $responseParser->parseInfo();
    }

    function getWebPage($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}