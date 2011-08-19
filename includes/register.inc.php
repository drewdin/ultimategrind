<?php
	require_once( './classes/Ps2/CheckPassword.php' );
	require_once( 'functions.inc.php' );
	
	$usernameMinChars = 6;
	$errors = array();
	
	$emailOK = check_email_address( $email );
	
	$checkPwd = new Ps2_CheckPassword( $password, $usernameMinChars );
	//$checkPwd->requireMixedCase();
	//$checkPwd->requireSymbols();
	$checkPwd->requireNumbers();
	$passwordOK = $checkPwd->check();
	
	if( !$emailOK ) {
		$errors[] = 'Your email address is invalid';
	}
	
	if( !$passwordOK ) {
		$errors[] = $checkPwd->getErrors();
	}
	
	if( $password != $retyped ) {
		$errors[] = 'Your passwords do not match.';
	}
	
	$response = recaptcha_check_answer( PRIVATE_KEY, $_SERVER['REMOTE_ADDR'], $_POST['recaptcha_challenge_field'], $_POST['recaptcha_response_field'] );
	
	if( !$response->is_valid ){
		$errors[] = 'The recaptcha values are incorrect';
	}
	
	if( !$errors ) {
		
		// check to see if the username is unique
		$sql = "SELECT `username` FROM `users` where `username` = '{$username}' ";
		$result = mysqli_query( $dbc, $sql) or die( mysqli_error() );
		$userCount = mysqli_num_rows( $result );
		
		// check to see if the password is unique
		$sql = "SELECT `password` FROM `users` where `password` = '{$password}' ";
		$result = mysqli_query( $dbc, $sql) or die( mysqli_error() );
		$emailCount = mysqli_num_rows( $result );
		
		if( $userCount == 0 ) {
			if( $emailCount == 0 ) {
				
				// encrypt the password and salt
				$pwd = sha1( $password . SALT );
				
				date_default_timezone_set( 'America/New_York' );
				$timestamp =  date( "Y/m/d H:i:s" );
				
				// prepare SQL statement
				$sql = "INSERT INTO `users` (`username`, `password`, `email`, `firstname`, `lastname`, `modified`, `created` )
						VALUES ( '{$username}', '{$pwd}', '{$email}', '{$firstname}', '{$lastname}', '{$timestamp}', '{$timestamp}' )";
				
				// insert details into database
				if( mysqli_query( $dbc, $sql ) === true ) {
					$redirect = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
					header( "Location: $redirect" );
					exit;
				} else {
					$errors[] = mysqli_error( $dbc );
				}
			} else {
				$errors[] = "$email is already taken, please choose another username.";
			}
		} else {	
			$errors[] = "$username is already taken, please choose another username.";
		}
	}