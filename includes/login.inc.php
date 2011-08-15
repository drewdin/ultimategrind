<?php
	require_once( 'functions.inc.php' );
	$errors = array();
	
	if( empty( $username ) ) {
		
		$errors[] = 'Username cannot be blank';
		
	}
	
	if( empty( $password ) ) {
		
		$errors[] = 'Your password cannot be blank';
		
	}
	
	
	if( !$errors ) {
		
		// encrypt the password and salt
		$pwd = sha1( $password . SALT );
		
		// Verify if the user is registered
		$sql = "SELECT `user_id`, `username`, `access` FROM `users` where `username` = '{$username}' AND `password` = '{$pwd}'";
		$userCount = mysqli_query( $dbc, $sql ) or die( mysqli_error( $dbc ) );
		
		if( mysqli_num_rows( $userCount ) == 1 ) {
						
			//The log-in is unique so set the user ID and username cookies, then redirect to the home page
			$row = mysqli_fetch_assoc( $userCount );
			$_SESSION['user_id'] = $row['user_id'];
			setcookie('user_id', $_SESSION['user_id'], time() + 3600);
			$_SESSION['username'] = $row['username'];
			setcookie('username', $_SESSION['username'], time() + 3600);
			$_SESSION['authenticated'] = $row['access'];
			
			date_default_timezone_set( 'America/New_York' );
			$timestamp =  date( "Y/m/d H:i:s" );
			$user_id = (int) $_SESSION['user_id'];
			$ipAddress = getIp();
			$browser = ( isset( $_SERVER['HTTP_USER_AGENT'] ) ) ? $_SERVER['HTTP_USER_AGENT'] : 'n/a';
			$sql = "INSERT INTO logins (`user_id`, `ip_address`, `browser`, `login`) VALUES ('{$user_id}', '{$ipAddress}', '{$browser}', '{$timestamp}')";
			mysqli_query( $dbc, $sql ) or die( mysqli_error( $dbc ) );
			
			//set the logout session info
			$sql = "SELECT `login_id`, `login` FROM `logins` WHERE `login` = '{$timestamp}' AND `user_id` = '" . $_SESSION['user_id'] . "'";
			$login_id = mysqli_query( $dbc, $sql ) or die( mysqli_error( $dbc ) );
			if( mysqli_num_rows( $login_id ) == 1 ) {
				
				$row = mysqli_fetch_assoc( $login_id );
				$_SESSION['login_id'] = $row['login_id'];
				setcookie('login_id', $_SESSION['login_id'], time() + 3600);
				$_SESSION['start'] = $row['login'];
				setcookie('start', $_SESSION['start'], time() + 3600);
				
			}
			
			session_regenerate_id();
			$redirect = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
			header( "Location: $redirect" );
			exit;
				
		} else {
			
			// if no match, prepare error message
			$errors[] = 'Sorry, you must enter a valid username and password to log in.';
			
		}
		
	}