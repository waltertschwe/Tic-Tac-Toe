<?php
include('TicTacToe.php');
$slotSelected = (int)$_GET['slot'];

$ticTacToe = new TicTacToe;

session_start();  
if(empty($_SESSION)) {
	error_log("INITIALIZING SESSION", 0);
	$ticTacToe->initSession();
} 

$playerSelection = $ticTacToe->playerSelection($slotSelected);
$playerWinner = $_SESSION['isPlayerWinner'];
if($playerWinner){
	//exit();
	//session_destroy();
}
$aiSelection = $ticTacToe->aiSelection($slotSelected);


$aiWinner = $_SESSION['isWinner'];
if($aiWinner) {
	//echo $aiSelection;
	//exit();
	//session_destroy();
}

echo $aiSelection;











