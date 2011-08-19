<?php
	// Start the session and check if it is valid
  	require_once( './includes/session_start.inc.php' );
  	require_once( './includes/session_check.inc.php' );
  	
	require_once( './includes/connection.inc.php' );
	require_once( './includes/functions.inc.php' );
	
	$errors = array();
	
	
	// connect to database
	$dbc = mysqli_connect( DB_HOST, DB_USER, DB_PASS, DB_NAME ) or die( mysqli_error( $dbc ) );
	
	// get categories from database
	$sql = 'SELECT `category_id`, `category` FROM `categories` ORDER BY `order`;';
	$data = mysqli_query( $dbc, $sql ) or die( 'Categories ' . mysqli_error( $dbc ) );
	
	$categories = array();
	while( $row = mysqli_fetch_assoc( $data ) ) {
		$categories[] = $row;
	}
	
	
	// Did user submit form?
	if( isset( $_REQUEST['submit'] ) ) {

		// create a timestamp and store each answer into the database
		$timestampResponse =  date( "Y/m/d H:i:s" );
		
		// store the timestamp for warm up insertion
		$_SESSION['timestampResponse'] = $timestampResponse;
		
		$sql = create_sql( $_SESSION['user_id'], $_REQUEST['answers'], $_SESSION['timestampResponse'] );
		$insertAnswer = mysqli_query( $dbc, $sql );
		if( $insertAnswer ) {
			$redirect = 'http://' . $_SERVER['HTTP_HOST'] . dirname( $_SERVER['PHP_SELF'] ) . '/warm_up.php';
			header( "Location: $redirect" );
		}  else {
			$errors[] = mysqli_error( $dbc );
		}
	}

	require_once( './includes/title.inc.php' );
	require_once( './includes/header.inc.php' );
	require_once( './includes/logo.inc.php' );
	
	echo '<a href="index.php">Back:</a>';
	echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
	
	foreach( $categories as $category ) :
		
		echo '<fieldset>';
		echo '<legend>' . $category['category'] . '</legend>';
		$questions = getQuestions( $category['category_id'] );
		
		foreach( $questions as $question ) :
			if( $question['question_id'] == 5 ) {
				$class = ' class="sideview"';
			} elseif( $question['question_id'] == 6 ) {
				$class = ' class="modified"';
			} else {
				$class = '';
			}
			echo '<p' . $class . '>';
			echo $question['question'];
			$values = getValues( $question['question_id'] );
			echo showQuestions( $values );
			echo '</p>';
		endforeach;
		
		echo '</fieldset>';
	
	endforeach;
	
	echo '<input type="submit" name="submit" value="submit" />';
	echo '</form>';
	
	require_once( './includes/footer.inc.php' );