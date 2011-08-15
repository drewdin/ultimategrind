<?php
	require_once('functions.inc.php');
	$warmupValues = array();
	$allValues = array();
	$values = array();
	$plans = array();
	
	// get the last warmup results from the db and dump into an array
	$sql = "SELECT `question_id`, `response` FROM `responses` WHERE `user_id` = '$_SESSION[user_id]' AND `created` = '$_SESSION[timestampResponse]'";
	$data = mysqli_query( $dbc, $sql ) or die( mysqli_error( $dbc ) );
	
	while( $row = mysqli_fetch_assoc( $data ) ) {
		
		// should i use the original keys?
		$warmupValues[$row['question_id']] = $row['response'];
		
	}
	
	
	// make sure it an array, break it into its parts
	if( is_array( $warmupValues ) ) {
		
		foreach( $warmupValues as $key => $value ) {
			
			// pushups(71), crunches(72), burpees(73)
			if( $key == 71 || $key == 72 || $key == 73 ) {
    			
    			$plans[$key] = $value;
    			
    		}
			
			// skip to the next key
			$dnu = array( 71, 72, 73 );
			if( in_array( $key, $dnu ) ) continue;
			
			//
    		if( $key != 4 && $key != 6 ) {
    			
        		$values[$key] = $value;
        		
    		} else {
    			
    			// (1), (2), (3) 
				$sidemod[$key] = $value;
			}
			
		}
		
	}

	
	// check the value of modified and calulate the value of sideview
	if( $sidemod[4] == 9 ) {
		
		unset( $sidemod[6] );
		
	} else {
		
		if( $sidemod[6] == 2 ) {
			
			$sidemod[4] = 2;
			
		} elseif( $sidemod[6] == 1 ) {
			
			$sidemod[4] = 1;
			
		}
	
	}
	
	// now combine the calculated sideview array with the other values into one array
	$allValues = $sidemod + $values;
	
	// get the min value to select the appropriate warmup
	$warmupSelection =  (int) min( $allValues );
	
	// select the warmup based on the input and save it to the db
	$warmup = warmupSelection( $warmupSelection );
	
	$sql = "INSERT INTO `warmups` (`user_id`, `warm_up`, `plyo`, `stability`, `strength`, `timestamp`) VALUES ( '$_SESSION[user_id]', '$warmupSelection', '$plans[71]', '$plans[72]', '$plans[73]', '$_SESSION[timestampResponse]' )";
	$data = mysqli_query( $dbc, $sql ) or die( mysqli_error( $dbc ) );