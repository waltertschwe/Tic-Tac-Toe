<?php

class TicTacToe {
	

	public function initSession() {
		
		//$sid = md5(uniqid(rand(), true));
		//session_id($sid);
		//session_start();
		
		$_SESSION['isWinner'] = 0;
		$_SESSION['isPlayerWinner'] = 0;
		$_SESSION['player'] = array();
		$_SESSION['ai']	    = array();
		$_SESSION['free']   = array(1=>1, 2=> 2, 3=> 3,4 =>4,5=>5,6=>6,7=>7,8=>8,9=>9);
		$_SESSION['winning-combos'] = array(array( 1=> 1, 2=> 2, 3=> 3), array( 1=> 4, 2=> 5, 3=> 6), array( 1=> 7, 2=> 8, 3=> 9), 
											array( 1=> 1, 2=> 4, 3=> 7), array( 1=> 2, 2=> 5, 3=> 8), array( 1=> 3, 2=> 6, 3=> 9),
											array( 1=> 1, 2=> 5, 3=> 9), array( 1=> 3, 2=> 5, 3=> 7));
											
		
	}
	
	public function playerSelection( $slot ) {
			
		$isWinner = 0;
		$winningValues = $_SESSION['winning-combos'];
		unset($_SESSION['free'][$slot]);
		$_SESSION['player'][$slot] = $slot;
		$playerSelections = $_SESSION['player'];
		foreach($winningValues as $key => $values) {
			##error_log("value = " . print_r($values,true),0);
			$winningPositions = 0;
			foreach($playerSelections as $playerSelection) {
				if(in_array($playerSelection, $values)) { 
				    $winningPositions++;
				} 
							
				if($winningPositions == 3) {	
					$isWinner = 1;
					break 2;
				}
			   
			}
		}
		
		if($isWinner > 0) {
		    $_SESSION['isPlayerWinner'] = 1;
		}
	
		return $slot;
	}
	
	public function aiSelection( $playerSelection) {
		
		
		$playerSlots = $_SESSION['player'];
		$aiSlots     = $_SESSION['ai'];
		$freeSlots   = $_SESSION['free'];
		$player 	 = 2; 
		$aiSelection = 0;
		
	
		$playerCount = count($playerSlots);
		
		## AI first selection	
		## if player doesn't take the center square AI takes it
		## if player does take center square AI takes a random corner
		if($playerCount == 1) {
			if($playerSelection != 5) {
				$_SESSION['ai'][5] = 5;
				unset($_SESSION['free'][5]);
				$aiSelection = 5;
			} else {
				$corners = array(1=>1, 3=>3, 7=>7, 9=>9);
				$slotSelected = array_rand($corners,1);
				$_SESSION['ai'][$slotSelected] = $slotSelected;
				unset($_SESSION['free'][$slotSelected]);
				$aiSelection = $slotSelected;
			}
			##error_log("FREE SLOTS AFTER AI MOVE = " . print_r($_SESSION['free'], true),0);
			return $aiSelection;
			
		} else {
			
			## Check for a winning move
			$aiSelection = $this->checkForWin($player);
			if($aiSelection > 0) {
				$_SESSION['isWinner'] = 1;
				##error_log("FREE SLOTS AFTER AI MOVE = " . print_r($_SESSION['free'], true),0);
				error_log("AI WINNER");
				return $aiSelection;
			}
			
			## Perform Defensive Move
			$aiSelection = $this->defensiveMove();
			if($aiSelection > 0) {
				$_SESSION['ai'][$aiSelection] = $aiSelection;
				unset($_SESSION['free'][$aiSelection]);
				##error_log("FREE SLOTS AFTER AI MOVE = " . print_r($_SESSION['free'], true),0);
				error_log("PERFORMING DEFENSIVE MOVE");
				return $aiSelection;
			}
			
			## Test for blocking forks
			## perform this before winning fork
			## if opponent can fork it sets up a move that forces them to block
			$aiSelection = $this->blockPlayerFork();
			if($aiSelection > 0) {
				$_SESSION['ai'][$aiSelection] = $aiSelection;
				unset($_SESSION['free'][$aiSelection]);
				//error_log("FREE SLOTS AFTER AI MOVE = " . print_r($_SESSION['free'], true),0);
				error_log("BLOCKED A PLAYER FORK");
				return $aiSelection;
				
			}

			## play a corner
			$corners = array(1=>1, 3=>3, 7=>7, 9=>9);
			foreach($freeSlots as $freeSlot) {
				if(in_array($freeSlot, $corners)) {
					$aiSelection = $freeSlot;
					$_SESSION['ai'][$aiSelection] = $aiSelection;
					unset($_SESSION['free'][$aiSelection]);
					error_log("AI SELECTED A CORNER");
					return $aiSelection;
				}
			}
			
			## play a side
			$sides = array(2=>2, 4=>4, 6=>6, 8=>8);
			foreach($freeSlots as $freeSlot) {
				if(in_array($freeSlot, $sides)) {
					$aiSelection = $freeSlot;
					$_SESSION['ai'][$aiSelection] = $aiSelection;
					unset($_SESSION['free'][$aiSelection]);
					error_log("AI SELECTED A SIDE");
					return $aiSelection;
				}
			}
		}	
	}

	public function checkForFork() {
		$freeSlots 	 = $_SESSION['free'];	
		$playerSlots = $_SESSION['player'];
		$aiSlots     = $_SESSION['ai'];
		$winningValues = $_SESSION['winning-combos'];
	}

	public function blockPlayerFork() {
		$freeSlots 	 = $_SESSION['free'];	
		$playerSlots = $_SESSION['player'];
		$aiSlots     = $_SESSION['ai'];
		$winningValues = $_SESSION['winning-combos'];
		
		$slotSelected = 0;
		
		$openPositions = array();
		
		## openPositions will return us 
		## possible combinations where we can make a triple
		## where the player hasn't blocked us.
		foreach($freeSlots as $freeSlot) {
			foreach($winningValues as $key => $values) {
				$possibleSlot = 1;
				if(in_array($freeSlot, $values)) {
					## free slot is in winning triple
					foreach($playerSlots as $playerSlot) {
						if(in_array($playerSlot, $values)) {
							## player breaks winning triple
							$possibleSlot = 0;
							break;
						} 
					}
				} else {
					$possibleSlot = 0;
				}
				
				if($possibleSlot > 0) {
					$openPositions[$freeSlot] = $freeSlot;
				}
			}	
		}
		
		## openPositions = a slot where AI can set itself up for a win on the next move
		## loop through potential open positions  
		## and determine the players forced move to block AI Victory allows them to fork
		## if it does do not select that position
		$aiNextMove = array();
		foreach($openPositions as $openPosition) {
			
			$playerForcedMove = 0;
			$aiSelection = 0;
			error_log("OPEN POSITION = " . $openPosition);
			$aiSlots[$openPosition] = $openPosition;
			unset($freeSlots[$openPosition]);
			foreach($winningValues as $key => $values) {
				
				$winningTriple = $values;
				$twoValues = array();
				foreach($aiSlots as $aiSlot) {
					if(in_array($aiSlot, $values)) {
						$twoValues[$aiSlot] = $aiSlot;
					}
				}
				
				$num = count($twoValues);
				if($num == 2) {
					$results = array_diff($winningTriple, $twoValues);
					## should return one result with the key/value of the player forced move
					foreach($results as $result) {
						$playerForcedMove = $result;
						$playerSlots[$playerForcedMove] = $playerForcedMove;
						unset($freeSlots[$playerForcedMove]);
						error_log("openPosition =" . $openPosition);
						error_log("playerForcedMove =" . $playerForcedMove);
						error_log("playerSlots =" . print_r($playerSlots, true),0);
						## check if player can make two in a row
						
						foreach($winningValues as $key => $values) {
							$potentialForks = 0;
							$playerArray = array();
							foreach($playerSlots as $playerSlot) {
								if(in_array($playerSlot, $values)) { 
								   $playerArray[$playerSlot] = $playerSlot;
								} 
							}
							$num = count($playerArray);
							
							if($num == 2) {
								$openSlot = array_diff($values, $playerArray);
								foreach($openSlot as $item) {
									//error_log("FREE SLOT =" . $item);
									if(in_array($item, $freeSlots)) {					
										$aiNextMove[$openPosition][$key] = $values;
									}
								}	
							}
						}
						
						$totalForks = count($aiNextMove[$openPosition]);
						error_log("OPEN POSITION = " . $openPosition . "POTENTIAL FORKS = " . $totalForks );
						## if player can make 2 forks don't use the open position
						if ($totalForks < 2) {
							return $openPosition;
						} 
					}
					
				}
			}
			## reset the board a move back;
			$freeSlots[$openPosition] = $openPosition;
			unset($aiSlots[$openPosition]);
			if($playerForcedMove > 0) {
				$freeSlots[$playerForcedMove] = $playerForcedMove;
				unset($playerForcedMove[$playerForcedMove]);
			}
		}
	
	return $slotSelected; 	
}


	public function defensiveMove() {
	

		$playerSlots = $_SESSION['player'];
		$aiSlots     = $_SESSION['ai'];
		$freeSlots   = $_SESSION['free'];	
		$winningValues = $_SESSION['winning-combos'];
		$winningPairs  = array();
		$aiSelection   = 0;
		
		## Loop through player possibilties of having a winning move
		foreach ($playerSlots as $playerSlot) {
			foreach ($winningValues as $key => $values) {
				$foundKey = array_search($playerSlot, $values);
				if(!empty($foundKey)) {
					$winningPairs[$key][$foundKey] = $values[$foundKey];
				}
			}
		}
		
		foreach ($winningPairs as $key => $values) {
			$num = count($values);
			if($num > 1) {
				$removeCombo = $key;
				$aiSelections = $winningValues[$key];
				foreach ($values as $value) {
					$slotChosen = array_search($value, $winningValues[$key]); 
					if($slotChosen > 0) {
						unset($aiSelections[$slotChosen]);
					}
				}
				## at this point there should only be one value in the array
				foreach($aiSelections as $key => $value) {
					$aiSelection = $value;
				}
				
				if(in_array($aiSelection, $freeSlots)) {
					break;
				} else {
					unset($aiSelection);
					continue;
				}
			}
		}
		
		return $aiSelection;
	}
	
	public function checkForWin($player) {
		
		$winningValue = 0;
		$winningPairs  = array();
		$freeSlots   = $_SESSION['free'];	
		$winningValues = $_SESSION['winning-combos'];
		
		if($player == 1) {
			$offensiveSlots = $_SESSION['player'];
			$defensiveSlots = $_SESSION['ai'];
		} else {
			$offensiveSlots = $_SESSION['ai'];
			$defensive      = $_SESSION['player'];
		}
		
		## loop through slots chosen
		foreach ($offensiveSlots as $offensiveSlot) {
			## compare against winning combinations
			foreach ($winningValues as $key => $values) {
			$foundKey = array_search($offensiveSlot, $values);
				## if selection is in winning pair add it to potential winning pairs
				if(!empty($foundKey)) {
					$winningPairs[$key][$foundKey] = $values[$foundKey];
				}
			}
		}
		
		##error_log("winning pairs =  " . print_r($winningPairs,true), 0);
		foreach ($winningPairs as $key => $values) {
			$num = count($values);
			
			if($num > 1) {
				## can win with one move if the slot is free
				$winningTriple = $winningValues[$key];
				#loop through the two selections we've already made that are in the winning pair
				foreach ($values as $value) {
					$selection = array_search($value, $winningTriple); 
					if($selection > 0) {
						unset($winningTriple[$selection]);
					}
				}
								
				## potential winning Value if slot is free
				foreach ($winningTriple as $winTripleValue) {
					$winningValue = $winTripleValue;
				}
				
				##error_log("free slots =  " . print_r($freeSlots,true), 0);
				##error_log("winningValue = " . $winningValue);
				if(in_array($winningValue, $freeSlots)) {
					return $winningValue;
				} else {
					continue;
				}
				
			}			
		}
		
	}

}
