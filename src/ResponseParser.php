<?php


class ResponseParser
{
    private $info;

    function __construct($info) {
        $this->info = $info;
    }

    function parseInfo() {
        return json_decode($this->info, true);
    }
}