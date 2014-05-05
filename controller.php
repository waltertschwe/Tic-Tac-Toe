<?php
include('TicTacToe.php');
$slotSelected = (int)$_POST['slot'];

$ticTacToe = new TicTacToe;



$sessionId = session_id();
if(empty($sessionId)) {  
	$ticTacToe->initSession();
} else {
	session_start($sessionId);
}



$playerSelection = $ticTacToe->playerSelection($slotSelected);
$_SESSION['player'][$playerSelection] = $playerSelection;
unset($_SESSION['free'][$playerSelection]);
$aiSelection = $ticTacToe->aiSelection($slotSelected);


$aiWinner = $_SESSION['isWinner'];
$playerWinner = $_SESSION['playerWinner'];

if($aiWinner) {
	session_destroy();
}

if($playerWinner){
	session_destroy();
}



echo $aiSelection;








