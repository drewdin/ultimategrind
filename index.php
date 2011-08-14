<?php

	require_once( './includes/session_start.inc.php' );

	require_once( './includes/title.inc.php' );

	require_once( './includes/header.inc.php' );
	
	require_once( './includes/logo.inc.php' );

	require_once( './includes/nav_menu.inc.php' );
	
?>

	<div id="welcome">
		
		
		<h2>Welcome to The Ultimate Grind</h2>
		<p>
			Welcome to the ultimate grind, here you will get a personalized warmup routine based on your previous workout with me, <b>Coach Sweat</b>. I want you to
			fill out an assessment form after your first workout with me and then every 3 weeeks after. Please answer all questions honestly as this is the
			only way to get the specific workout specialized for you. If you have any questions dont hesitate to call or email me. Have fun and get going, 
			if your not sweating your not working!
		</p>
		
		<h3>The most recent users</h3>
		<?php
		require_once( './includes/connection.inc.php' );
		$dbc = mysqli_connect( DB_HOST, DB_USER, DB_PASS, DB_NAME ) or die( mysqli_error( $dbc ) );
		$sql = 'SELECT `username` FROM `users` limit 5';
		$result = mysqli_query( $dbc, $sql ) or die( mysqli_error( $dbc ) );
		$count = mysqli_num_rows( $result );
		
		echo '<ul>';
		while( $row = mysqli_fetch_assoc( $result ) ) {
			
			$user = ucfirst( $row['username'] );
			echo "<li>$user</li>";
			
		}
		echo '</ul>';
		?>
		
	</div>

<?php	
	require_once( './includes/footer.inc.php' );