<?php

require "ConsoleUI.php";
require "WebClient.php";

class Controller
{
    private $url, $console, $client, $pid;

    function __construct() {}

    function requestGame() { // Gathers info for a new game
        $this->console = new ConsoleUI();

        $this->url = $this->console->promptServer();

        $this->client = new WebClient();

        echo "Obtaining server information ......";

        $info = $this->client->getInfo($this->url . "/info");

        $strategy = $this->console->promptStrategy($info['strategies']);

        $this->pid = $this->client->getInfo($this->url . "/new/?strategy=" . $strategy)['pid'];

        $this->playGame();
    }

    private function playGame() { // Prompts the user for moves
        do {
            $this->printBoard();

            input:
            echo "\nEnter a move: ";
            $move = readline();

            if (!is_numeric($move)){
                echo "\nInvalid move: " . $move;
                goto input;
            }
            elseif ((int) $move  < 0 | (int) $move > 6) {
                echo "\nInvalid move: " . $move;
                goto input;
            }

            $info = $this->client->getInfo($this->url . "/play/?pid=" . $this->pid . ".txt&move=" . $move);

            $this->console->board = $this->client->getInfo($this->url . "/writable/" . $this->pid . ".txt")['board'];

        } while ($this->endGame($info) == FALSE);
    }

    private function endGame($info) { // Checks if game is complete
        if ($info['ack_move']['isWin'] == true) {
            $this->printBoard();

            echo "\nYOU WON!";
            echo "\nWinning row: ". json_encode($info['ack_move']['row']);
            return true;
        }
        else if($info['move']['isWin'] == true) {
            $this->printBoard();

            echo "\nYOU LOST!";
            echo "\nWinning row: ". json_encode($info['move']['row']);
            return true;
        }
        else if ($info['ack_move']['isDraw'] == true) {
            $this->printBoard();

            echo "\nDRAWN!";
            return true;
        }

        return false;
    }

    private function printBoard() { // Prints the board
        echo "\n";
        for ($i = 0; $i < 6; $i++) {
            for ($j = 0; $j < 7; $j++) {
                if ($this->console->board[$i][$j] == 0) echo " " . ".";
                else echo " " . $this->console->board[$i][$j];
            }
            echo "\n";
        }
    }
}