<?php
	require_once('./includes/session_start.inc.php');
	
	require_once('./includes/session_check.inc.php');

	require_once( './includes/title.inc.php' );

	require_once( './includes/header.inc.php' );
	
	require_once( './includes/logo.inc.php' );

	require_once( './includes/nav_menu.inc.php' );

	echo '<div id="results">';
	
	require_once( './includes/connection.inc.php' );
	$dbc = mysqli_connect( DB_HOST, DB_USER, DB_PASS, DB_NAME ) or die( mysqli_error( $dbc ) );
	$sql = "SELECT `warmup_id`, `user_id`, `warm_up`, `timestamp` FROM `warmups` WHERE `user_id` = '$_SESSION[user_id]' ORDER BY `timestamp` DESC";
	$warmupList = mysqli_query( $dbc, $sql ) or die( mysqli_error( $dbc ) );
	$count = mysqli_num_rows( $warmupList );
	
	echo '<h2>' . ucfirst( $_SESSION['username'] ) . ' Recent Warmup Routines</h2>';
	
	if( $count > 0 ) {
		
		require_once( './includes/functions.inc.php' );
		echo '<table>';
		
		while( $row = mysqli_fetch_assoc( $warmupList ) ) {
			echo '<tr>';
			echo '<td><a href="warm_up.php?warmup_id=' . $row['warmup_id'] . '">' . formatDate( $row['timestamp'] ) . '</a></td>';
			echo '</tr>';
		}
		echo '<table>';
		
	} else {
		
		echo '<p>No records were found</p>';
	
	}
	echo '</table>';
	echo '</div>';
	
	require_once( './includes/footer.inc.php' );