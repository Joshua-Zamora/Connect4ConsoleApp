<?php
include "Controller.php";

main();

function main() {
    $controller = new Controller();
    $controller->requestGame();
}

