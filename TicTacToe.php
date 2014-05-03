<?php

class TicTacToe {
	

	public function initSession() {
		session_start();
		$sesId = session_id(); 
		$_SESSION['isWinner'] = 0;
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
		
		return $slot;
	}
	
	public function aiSelection( $playerSelection) {
		
		$playerSlots = $_SESSION['player'];
		$aiSlots     = $_SESSION['ai'];
		$freeSlots   = $_SESSION['free'];
	
		$playerCount = count($playerSlots);
		
		## AI first selection	
		## if player doesn't take the center square AI takes it
		## if player does take center square AI takes top left corner slot #1
		## TODO: AI should take random corner slot
		if($playerCount <= 1) {
			if($playerSelection != 5) {
				$_SESSION['ai'][5] = 5;
				unset($_SESSION['free'][5]);
				$aiSelection = 5;
			} else {
				$_SESSION['ai'][1] = 1;
				unset($_SESSION['free'][1]);
				$aiSelection = 1;
			}
			return $aiSelection;
		} else {
			
			## TODO: skip if AI second move
			## All moves after first move	
			$aiSelection = $this->checkForWin();
			if($aiSelection > 0) {
				$_SESSION['isWinner'] = 1;
				return $aiSelection;
			}
		    
			## TODO: build Perform Defensive Move method
			$aiSelection = $this->defensiveMove();
			if($aiSelection > 0) {
				echo "ai performing defensive move<br/>";
				return $aiSelection;
			}
			
			## TODO: Currently Picks Random Position - Add offensive moves
			$aiSelection = array_rand($freeSlots,1);
			echo "had to make a random selection<br/>";
			$_SESSION['ai'][$aiSelection] = $aiSelection;
			unset($_SESSION['free'][$aiSelection]);
			return $aiSelection;
			
		}	
	}
	
	
	public function defensiveMove() {
	
		
		
	}
	
	public function checkForWin() {
			
		$playerSlots = $_SESSION['player'];
		$aiSlots     = $_SESSION['ai'];
		$freeSlots   = $_SESSION['free'];	
		$winningValues = $_SESSION['winning-combos'];
		$winningPairs  = array();
		
		## loop through slots chosen
		foreach ($aiSlots as $aiSlot) {
			## compare against winning combinations
			foreach ($winningValues as $key => $values) {
			$foundKey = array_search($aiSlot, $values);
				if(!empty($foundKey)) {
					$winningPairs[$key][$foundKey] = $values[$foundKey];
				}
			}
		}
		
		foreach ($winningPairs as $key => $values) {
			$num = count($values);
			
			if($num > 1) {
				
				## ai can win with one move if the slot is free
				$winningTriple = $winningValues[$key];
				#loop through the two selections we've already made that are in the winning pair
				foreach ($values as $value) {
					$aiSelection = array_search($value, $winningTriple); 
					if($aiSelection > 0) {
						unset($winningTriple[$aiSelection]);
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
