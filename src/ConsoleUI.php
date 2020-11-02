<?php

define('WRITE', dirname(dirname(__FILE__))."/writable/");

class ConsoleUI
{
    public $board;

    function __construct() {
        $this->board = array(           // Constructs a 6 x 7 2d array
            array(0, 0, 0, 0, 0, 0, 0),
            array(0, 0, 0, 0, 0, 0, 0),
            array(0, 0, 0, 0, 0, 0, 0),
            array(0, 0, 0, 0, 0, 0, 0),
            array(0, 0, 0, 0, 0, 0, 0),
            array(0, 0, 0, 0, 0, 0, 0)
        );
    }

    function promptServer() { // Asks user for server url
        echo "\nEnter the server URL [default: https://cssrvlab01.utep.edu/classes/cs3360/jazamora6] ";
        return readline();
    }

    function promptStrategy($strategies) { // Asks user for chosen strategy
        echo "\nSelect the server strategy: 1. $strategies[0] 2. $strategies[1] [default: 1] ";
        $line = readline();

        switch ((int) $line) {
            case 1:
                echo "Selected strategy: " . $strategies[0];
                return $strategies[0];

            case 2:
                echo "Selected strategy: " . $strategies[1];
                return $strategies[1];

            default:
                echo "Invalid selection: " . $line . "\n";
                echo "Using default strategy: " . $strategies[0];
                return $strategies[0];
        }
    }
}