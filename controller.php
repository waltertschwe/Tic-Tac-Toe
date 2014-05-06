<?php
include('TicTacToe.php');

$response = array();
$slotSelected = (int)$_GET['slot'];

$ticTacToe = new TicTacToe;

session_start();  
if(empty($_SESSION)) {
	//error_log("INITIALIZING SESSION", 0);
	$ticTacToe->initSession();
} 

$playerSelection = $ticTacToe->playerSelection($slotSelected);
unset($_SESSION['free'][$playerSelection]);
$playerWinner = $_SESSION['isPlayerWinner'];
if($playerWinner){
	
}
$aiSelection = $ticTacToe->aiSelection($slotSelected);
$aiWinner = $_SESSION['isWinner'];
if($aiWinner) {
	session_destroy();

	$response['aiWinner'] = 1;
} else {
	$response['aiWinner'] = 0;
}

$response['aiSelection'] = $aiSelection;
echo json_encode($response);












