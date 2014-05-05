<?php

class TicTacToe {
	

	public function initSession() {
		session_start();
		$sesId = session_id(); 
		$_SESSION['isWinner'] = 0;
		$_SESSION['isPlayerWinner'] = 0;
		$_SESSION['player'] = array();
		$_SESSION['ai']	    = array();
		$_SESSION['free']   = array(1=>1, 2=> 2, 3=> 3,4 =>4,5=>5,6=>6,7=>7,8=>8,9=>9);
		$_SESSION['winning-combos'] = array(array( 1=> 1, 2=> 2, 3=> 3), array( 1=> 4, 2=> 5, 3=> 6), array( 1=> 7, 2=> 8, 3=> 9), 
											array( 1=> 1, 2=> 4, 3=> 7), array( 1=> 2, 2=> 5, 3=> 8), array( 1=> 3, 2=> 6, 3=> 9),
											array( 1=> 1, 2=> 5, 3=> 9), array( 1=> 3, 2=> 5, 3=> 7));
		
		$_SESSION['session_id'] = $sesId;
	
	}
	
	public function playerSelection( $slot ) {
		$_SESSION['player'][$slot] = $slot;
		unset($_SESSION['free'][$slot]);
		$isWinner = $this->checkForWin($player);
		if($isWinner > 0) {
			$_SESSION['isPlayerWinner'] = 1;
		}
	
		return $slot;
	}
	
	public function aiSelection( $playerSelection) {
		
		$playerSlots = $_SESSION['player'];
		$aiSlots     = $_SESSION['ai'];
		$freeSlots   = $_SESSION['free'];
	
		$playerCount = count($playerSlots);
		
		## AI first selection	
		## if player doesn't take the center square AI takes it
		## if player does take center square AI takes a random corner
		if($playerCount <= 1) {
			echo "ai's first move ";
			if($playerSelection != 1) {
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
			
			return $aiSelection;
			
		} else {
			$player = 2; 
			$aiSelection = 7;
			return $aiSelection;
			$aiSelection = $this->checkForWin($player);
			if($aiSelection > 0) {
				$_SESSION['isWinner'] = 1;
				return $aiSelection;
			}
			
			## Perform Defensive Move
			$aiSelection = $this->defensiveMove();
			if($aiSelection > 0) {
				echo "ai performing defensive move<br/>";
				return $aiSelection;
			}
			
			## Test for winning forks 
			$aiSelection = $this->checkForForks( $aiSlots, 2 );
			if($aiSelection > 0) {
				echo "offensive fork = " . $aiSelection;
				$_SESSION['ai'][$aiSelection] = $aiSelection;
				unset($_SESSION['free'][$aiSelection]);
				return $aiSelection;
			}
			
			## Test for blocking forks
			$aiSelection = $this->checkForForks( $playerSlots, 1 );
			if($aiSelection > 0) {
				echo "defensive fork = " . $aiSelection;
				$_SESSION['ai'][$aiSelection] = $aiSelection;
				unset($_SESSION['free'][$aiSelection]);
				return $aiSelection;
			}
			
			## TODO: Pick Random Position
			$aiSelection = array_rand($freeSlots,1);
			echo "had to make a random selection<br/>";
			$_SESSION['ai'][$aiSelection] = $aiSelection;
			unset($_SESSION['free'][$aiSelection]);
			return $aiSelection;
			
		}	
	}

	public function checkForForks( $selections, $player ) {
		
		echo "checking for fork...";
		$freeSlots   = $_SESSION['free'];	
		$winningValues = $_SESSION['winning-combos'];
		$slotChosen = 0;
		
		##check 
		foreach ($freeSlots as $freeSlot) {
			$selections[$freeSlot] = $freeSlot;
			$potentialTriples = $this->evaluateTriples($selections, $player);
			
			if($potentialTriples >= 2 ) {
				$slotChosen = $freeSlot;
				break;
			}
		}
		
		return $slotChosen;
			
	}
	
	public function evaluateTriples( $selections, $player) {
			
		$winningValues = $_SESSION['winning-combos'];
		
		## ai is player 2. compare against opposing player
		if($player == 1) {
			$playerSlots   = $_SESSION['ai'];
		} else {
			$playerSlots   = $_SESSION['player'];
		}
		
		$potentialFork = 0;
		foreach ($selections as $selection) {
			foreach ($winningValues as $key => $values) {
				$foundKey = array_search($selection, $values);
				if(!empty($foundKey)) {
					$winningPairs[$key][$foundKey] = $values[$foundKey];
				}
			}
		}
	
		foreach ($winningPairs as $key => $values) {
			$num = count($values);
			$playerSelected = 0;
			## we have a possible winning Triple
			if($num == 3) {
				foreach($values as $value) {
					if(in_array($value, $playerSlots)) {
						$playerSelected = 1;
					}
				}
				
				if($playerSelected == 0) {
					$potentialFork++;
				}
			}
		}
		
		return $potentialFork;
			
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
		
		## remove the winning combo and ai selection from the board
		if($aiSelection > 0 ) {
			//unset($_SESSION['winning-combos'][$removeCombo]);
			unset($_SESSION['free'][$aiSelection]);
			$_SESSION['ai'][$aiSelection] = $aiSelection;
			return $aiSelection;
		} else {
			return $aiSelection;
		}
	}
	
	public function checkForWin($player) {
		
		## check if player won
		if($player == 1) {
			$offensiveSlots = $_SESSION['player'];
			$defensiveSlots = $_SESSION['ai'];
		} else {
			$offensiveSlots = $_SESSION['player'];
			$defensiveSlots = $_SESSION['ai'];
		}
		
		$freeSlots   = $_SESSION['free'];	
		$winningValues = $_SESSION['winning-combos'];
		$winningPairs  = array();
		
		## loop through slots chosen
		foreach ($offensiveSlots as $offensiveSlot) {
			## compare against winning combinations
			foreach ($winningValues as $key => $values) {
			$foundKey = array_search($offensiveSlot, $values);
				if(!empty($foundKey)) {
					$winningPairs[$key][$foundKey] = $values[$foundKey];
				}
			}
		}
		
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
				
				if(in_array($winningValue, $freeSlots)) {
					## ai wins
					return $winningValue;
				} else {
					continue;
				}
				
			}			
		}
	}

	
}
