<?php
	// If the user is logged in, enter it into the db and delete the session vars to log them out
	session_start();
	
	// get the variables
	require_once( './includes/connection.inc.php' );
	
	//log the logout in the db
	$login_id = (int) $_SESSION['login_id'];
	$dbc = mysqli_connect( DB_HOST, DB_USER, DB_PASS, DB_NAME ) or die( mysqli_error( $dbc ) );
	$timestamp =  date("Y/m/d H:i:s");
	$sql = "UPDATE `logins` SET `logout` = '{$timestamp}' WHERE `login_id` = '{$login_id}'";
	mysqli_query( $dbc, $sql ) or die( mysqli_error( $dbc ) );
	
	if( isset( $_SESSION['user_id'] ) ) {
		
		//Delete the session vars by clearing the $_SESSION array
		$_SESSION = array();  
		
		//Delete the session cookie by setting its expiration to an hour in the past (3600)
		if( isset( $_COOKIE[session_name()] ) ) {
			
			setcookie( session_name(), '', time() - 86400, '/' );
			
		}
		//Destroy the session
		session_destroy();
	}
	//Delete the user_id, username and login_id cookies and redirect to the home page
	setcookie( 'user_id', '', time() - 86400 );
	setcookie( 'username', '', time() - 86400 );
	setcookie( 'login_id', '', time() - 86400 );
	
	//Redirect to the home page
	$redirect = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
	header( 'location: ' . $redirect );
	exit();