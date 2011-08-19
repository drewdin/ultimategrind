<?php
	function create_sql( $user_id, $answers, $timestamp ) {
		
		foreach( $answers AS $key => $value ) {
			$setData[] = "( {$user_id}, '{$key}', '{$value}', '{$timestamp}', '{$timestamp}' )";                 
		}
	
		$setData = implode( ', ', $setData );
		$sql = "INSERT INTO responses ( user_id, question_id, response, modified, created ) VALUES {$setData};";
		
		return( $sql );
	    
	}
	
	
	function getQuestions( $category_id ) {
		
		$dbc = mysqli_connect( DB_HOST, DB_USER, DB_PASS, DB_NAME ) or die( mysqli_error() );
		$sql = "SELECT `question_id`, `category_id`, `question` FROM questions WHERE `category_id` = '{$category_id}' ORDER BY `order` ASC;";
		$result = mysqli_query( $dbc, $sql ) or die( mysqli_error( $dbc ) );
		
		$questions = array();
		while( $row = mysqli_fetch_assoc( $result ) ) {
			$questions[] = $row;
		}
		
		return $questions;
		
	}
	
	
	function showQuestions( $data ) {
		
		if( is_array( $data ) ) {
			foreach( $data as $value ) {
				if( $value['question_id'] == 6 ) {
					$class = 'class="modified"';
				}
				switch( $value['type'] ) {
				    case 1:
						echo '<label><input type="radio" name="answers[' . $value['question_id'] . ']" value="' . $value['value'] . '" required />' . ucwords( $value['display_value'] ) . '</label>';
				    	break;
				    case 2:
						echo '<label><input type="text" name="answers[' . $value['question_id'] . ']" required /></label>';
						break;
					case 3:
						echo '<label><input type="checkbox" name="answers[' . $value['question_id'] . ']" /></label>';
						break;
				}
			}
			
		} else {
			echo 'showQuestions are not an array';
		}
		
	}
	
	
	function getValues( $question_id ) {
	
		$dbc = mysqli_connect( DB_HOST, DB_USER, DB_PASS, DB_NAME ) or die( mysqli_error() );
		$sql = "SELECT `values`.`type`, `values`.`question_id`, `values`.`value`, `display_values`.`display_value`
				FROM `values`
				INNER JOIN `display_values` ON `display_values`.`display_value_id` = `values`.`display_value_id`
				WHERE `question_id` = '{$question_id}'
				ORDER BY `order` ASC;";
		$data = mysqli_query( $dbc, $sql ) or die( mysqli_error( $dbc ) );
		
		$result = array();
		while( $row = mysqli_fetch_assoc( $data ) ) {
			$result[] = $row;
		}
		return $result;
		
	}
	
	
	function getIp() {
	
		if( !empty(	$_SERVER['HTTP_CLIENT_IP']	) ) {
			
			$ip = $_SERVER['HTTP_CLIENT_IP'];
			
		} elseif( !empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			
		} else {
			
			$ip = $_SERVER['REMOTE_ADDR'];
			
		}
		
		return $ip;
		
	}
	
	
	function warmupSelection( $inputValue ) {
		
		$intInputValue = (int) $inputValue;
		switch( $intInputValue ) {
	    	case 1:
	        	$warmup = array('roll calves',
	        					'stretch calves',
	        					'toe raises',
	        					'body weight squats' );
	        	break;
	    	case 2:
	        	$warmup = array('roll hip flexors',
	        					'stretch hip flexors',
	        					'bridges',
	        					'body weight squats' );
	        	break;
	    	case 3:
	        	$warmup = array('roll calves',
	        					'stretch calves',
	        					'toe raises',
	        					'body weight squats' );
	        	break;
	        case 4:
	        	$warmup = array('Roll inside of left leg and outside of right hip',
	        					'stretch inside of left leg and outside of right hip',
	        					'left leg outside knee-pull lunges',
	        					'body weight squats (concentrate on keeping weight centered)' );
	        	break;
	        case 5:
	        	$warmup = array('roll the inside of both legs',
	        					'stretch the inside of both legs',
	        					'outside knee-pull lunges (both legs)',
	        					'body weight squats (concentrate on keeping knees from going in)' );
	        	break;
	        case 6:
	        	$warmup = array('roll lats',
	        					'stretch chest',
	        					'YTAW cobra combo',
	        					'one leg YTAW both legs' );
	        	break;
	        case 7:
	        	$warmup = array('roll inside of both legs',
	        					'stretch inside of both legs',
	        					'outside knee-pull lunges',
	        					'step up lunges progressing to single leg squat (both legs)' );
	        	break;
	        case 8:
	        	$warmup = array('outside knee-pull lunges (both legs)',
	        					'single leg YTAW (concentrate on maintaining arch)',
	        					'step up lunges progressing to single leg squat (both legs)',
	        					'multi-planar (front, side, twisting) hops to both legs' );
	        	break;
	        case 9:
	        	$warmup = array('bridges',
	        					'squats',
	        					'single leg squats, both legs',
	        					'one arm press standing on opposite leg',
	        					'1 leg YTAW on both legs',
	        					'deadlifts with no resistance',
	        					'single dead lift with cobra, progressing on stability pad',
	        					'one arm bent row standing on opposite leg' );
	        	break;
	        case 10:
	        	$warmup = array('Roll inside of right leg and outside of left hip',
	        					'stretch inside of right leg and outside of left hip',
	        					'right leg outside knee-pull lunges',
	        					'body weight squats (concentrate on keeping weight centered)' );
	        	break;
	        default:
	        	$errors[] = 'Not a valid warmup selection';
	        	break;
		}
		return ( isset( $errors ) ) ? $errors : $warmup; 
		
	}


	function formatDate( $date, $type = 1 ) {
		
		$formatted = '';
		switch( $type ) {
			case 1:
			// Saturday, July 30, 2011
			$result = date( 'l, F d, Y' , strtotime( $date ) );
			break;
		}
		return $result;
		
	}
	
	function plyoPlan( $data ) {
		
		// Burpees in two mins
		$plan = (int) $data;
		switch( $plan ) {
			case 0:
    			$plyoPlan = 'non-impact plyo';
    			break;
	    	case( $plan < 10 ):
	        	$plyoPlan = 'non-impact plyo';
	        	break;
	    	case( $plan > 10  && $plan < 25 ):
	        	$plyoPlan = 'stabilization plyo';
	        	break;
	    	case( $plan > 25 ):
	        	$plyoPlan = 'aggressive plyo';
	        	break;
	        default:
	        	$errors[] = 'Not a valid plyo plan selection';
	        	break;
		}
		return ( isset( $errors ) ) ? $errors : $plyoPlan;
		
	}
	
	
	function stabilityPlan( $data ) {
		
		// single leg squats in two mins
		$plan = (int) $data;
		switch( $plan ) {
			case 0:
    			$stabilityPlan = 'standard stability';
    			break;
	    	case( $plan < 10 ):
	        	$stabilityPlan = 'standard stability';
	        	break;
	    	case( $plan > 10 ):
	        	$stabilityPlan = 'advanced stability';
	        	break;
	        default:
	        	$errors[] = 'Not a valid stability plan selection';
	        	break;
		}
		return ( isset( $errors ) ) ? $errors : $stabilityPlan;
		
	}
	
	function strengthPlan( $data ) {
		
		// modified pushups in two mins
		$plan = (int) $data;
		switch( $plan ) {
			case 0:
    			$strengthPlan = 'standard strength';
    			break;
	    	case( $plan < 20 ):
	        	$strengthPlan = 'standard strength';
	        	break;
	    	case( $plan > 20 ):
	        	$strengthPlan = 'advanced strength';
	        	break;
	        default:
	        	$errors[] = 'Not a valid strength plan selection';
	        	break;
		}
		return ( isset( $errors ) ) ? $errors : $strengthPlan;
		
	}
	
	function check_email_address( $email ) {
	$email_pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i';
	if( !preg_match( $email_pattern, $email ) ) {
		return false;
	}
	
	$atIndex = strrpos($email, "@");
	if( is_bool( $atIndex ) && !$atIndex ) {
		return false;
	} else {
		$domain = substr( $email, $atIndex + 1 );
		$local = substr( $email, 0, $atIndex );
		
		$localLen = strlen( $local );
		$domainLen = strlen( $domain );
		if( $localLen < 1 || $localLen > 64 ) {
			// local part length exceeded
			return false;
		} elseif( $domainLen < 1 || $domainLen > 255 ) {
			// domain part length exceeded
			return false;
		}
	}
	
	if( !preg_match( '/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace( "\\\\", "", $local ) ) ) {
		// character not valid in local part unless local part is quoted
		if( !preg_match( '/^"(\\\\"|[^"])+"$/', str_replace( "\\\\", "", $local ) ) ) {
			return false;
		}
	}
	
	if( $local[0] == '.' || $local[$localLen - 1] == '.' ) {
		// local part starts or ends with '.'
		return false;
	} elseif( preg_match( '/\\.\\./', $local ) ) {
		// local part has two consecutive dots
		return false;
	}
	
	if( !preg_match( '/^[A-Za-z0-9\\-\\.]+$/', $domain ) ) {
		// character not valid in domain part
		return false;
	}
	
	if ( preg_match( '/\\.\\./', $domain ) ) {
		// domain part has two consecutive dots
		return false;
	}
	
	if( !( checkdnsrr( $domain, "MX" ) || checkdnsrr( $domain, "A" ) ) ) {
		// domain not found in DNS
		return false;
	}
	return true;
}