<?php

include('TicTacToe.php');
$slotSelected = (int)$_GET['slot'];

$ticTacToe = new TicTacToe;

$session = $_SESSION;
if (empty($session)) {
    $ticTacToe->initSession();
}

$ticTacToe->playerSelection($slotSelected);
$aiSelection = $ticTacToe->aiSelection($slotSelected);


//echo $aiSelection;
var_dump($_SESSION);





