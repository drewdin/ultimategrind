<?php
	// Start the session and check if it is valid
  	require_once( './includes/session_start.inc.php' );
  	require_once( './includes/session_check.inc.php' );
  	
  	$errors = array();

	// connect to the db
	require_once( './includes/connection.inc.php' );
	require_once( './includes/functions.inc.php' );
	$dbc = mysqli_connect( DB_HOST, DB_USER, DB_PASS, DB_NAME ) or die('Could not connect to database');
	
	// add header info
	require_once( './includes/title.inc.php' );
	require_once( './includes/header.inc.php' );
	
	// add logo and menu
	require_once( './includes/logo.inc.php' );
	require_once( './includes/nav_menu.inc.php' );

	echo '<div id="results">';
	if( isset( $_GET['warmup_id'] ) ) {
		
		// ger warmup information from the database
		$wuid = (int) $_GET['warmup_id'];
		$sql = "SELECT `warm_up`, `plyo`, `strength`, `stability`, `timestamp` FROM `warmups` WHERE `user_id` = '$_SESSION[user_id]' AND `warmup_id` = '$wuid'";
		$wu = mysqli_query( $dbc, $sql ) or die( mysqli_error( $dbc ) );
		$count = mysqli_num_rows( $wu );
		
		if( $wu && $count == 1 ) {
			
			$wun = mysqli_fetch_assoc( $wu );
			$dispWarmup = warmupSelection( $wun['warm_up'] );
			$dispPlyo = plyoPlan( $wun['plyo'] );
			$dispStrength = strengthPlan( $wun['strength'] );
			$dispStability = stabilityPlan( $wun['stability'] );
			
			echo '<h2>' . ucfirst( $_SESSION['username'] ) . ', here are your personalized routines from ' . formatDate( $wun['timestamp'] ) . '</h2>';
			$i = 0;
			echo '<h3>Warmup Routine</h3>';
			foreach( $dispWarmup as $routine ) :
				
				$i++;
				echo '<p>' . $i . ') - ' . ucwords( $routine ) . '</p>';
				
			endforeach;
			
			echo '<h3>Plyo Plan</h3>';
			if( !is_array( $dispPlyo ) ) {
				echo ucwords( $dispPlyo );
			}
			
			echo '<h3>Stability Plan</h3>';
			if( !is_array( $dispStability ) ) {
				echo ucwords( $dispStability );
			}
			
			echo '<h3>Strength Plan</h3>';
			if( !is_array( $dispStrength ) ) {
				echo ucwords( $dispStrength );
			}
			
		} else {
			
			$errors[] = 'There is more than one count which is impossible!';
			
		}
		
	} else {
		
		// get results entered from user and display the warmup
		require_once('./includes/warm_up.inc.php');
		
		// retreive the latest values from the warmup table and display the results below
		
		$sql = "SELECT `warm_up`, `plyo`, `strength`, `stability`, `timestamp` FROM `warmups` WHERE `user_id` = '$_SESSION[user_id]' AND `timestamp` = '$_SESSION[timestampResponse]';";
		//$sql = "SELECT `question_id`, `response` FROM `responses` WHERE `user_id` = '$_SESSION[user_id]' AND `created` = '$_SESSION[timestampResponse]'";
		$wu = mysqli_query( $dbc, $sql ) or die( mysqli_error( $dbc ) );
		$count = mysqli_num_rows( $wu );
		$wun = mysqli_fetch_assoc( $wu );
		
		$dispWarmup = warmupSelection( $wun['warm_up'] );
		$dispPlyo = plyoPlan( $wun['plyo'] );
		$dispStrength = strengthPlan( $wun['strength'] );
		$dispStability = stabilityPlan( $wun['stability'] );
			
		echo '<h2>' . ucfirst( $_SESSION['username'] ) . ' personalized routine</h2>';
		$i = 0;
		foreach( $dispWarmup as $routine ) :
			
			$i++;
			echo '<p>' . $i . ') - ' . ucwords( $routine ) . '</p>';
			
		endforeach;
		
		echo '<h3>Plyo Plan</h3>';
		if( !is_array( $dispPlyo ) ) {
			echo ucwords( $dispPlyo );
		}
		
		echo '<h3>Stability Plan</h3>';
		if( !is_array( $dispStability ) ) {
			echo ucwords( $dispStability );
		}
		
		echo '<h3>Strength Plan</h3>';
		if( !is_array( $dispStrength ) ) {
			echo ucwords( $dispStrength );
		}
		
	}
	echo '</div>';
	require_once( './includes/footer.inc.php' );