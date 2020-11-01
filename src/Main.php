<?php
include "Controller.php";

main();

function main() {

    //$url = 'https://cssrvlab01.utep.edu/classes/cs3360/jazamora6';

    $controller = new Controller();
    $controller->requestGame();
}

