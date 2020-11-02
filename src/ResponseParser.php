<?php


class ResponseParser
{
    private $info;

    function __construct($info) {
        $this->info = $info;
    }

    function parseInfo() { // Parses given json string
        return json_decode($this->info, true);
    }
}