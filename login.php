<?php
	error_reporting( E_ALL );
	
	//Start the session
  	require_once( './includes/session_start.inc.php' );
	
	// connect to db
	require_once( './includes/connection.inc.php' );
	$dbc = mysqli_connect( DB_HOST, DB_USER, DB_PASS, DB_NAME ) or die( mysqli_error( ) );
	
	if ( isset( $_REQUEST['login'] ) ) {
		
		$username = mysqli_real_escape_string( $dbc, trim( $_POST['username'] ) );
		$password = mysqli_real_escape_string( $dbc, trim( $_POST['pwd'] ) );
		require_once( './includes/login.inc.php' );

	}
	
	require_once( './includes/title.inc.php' );

	require_once( './includes/header.inc.php' );
	
	require_once( './includes/logo.inc.php' );
	
	require_once( './includes/nav_menu.inc.php' );
?>
			<h1>Login to Ultimate Grind Personal Warmup page</h1>
			<?php
			if ( isset( $success ) ) {
				echo "<p class='success'>$success</p>";
			} elseif ( isset( $errors ) && !empty( $errors ) ) {
				echo '<ul>';
				foreach ( $errors as $error ) {
					echo "<li class='error'>$error</li>";
				}
				echo '</ul>';
			}
			?>
			<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
				
				<p>
				    <label for="username">Username:</label>
				    <input type="text" name="username" id="username" required>
				</p>
				
				<p>
				    <label for="pwd">Password:</label>
				    <input type="password" name="pwd" id="pwd" required>
				</p>
				
				<p>
					<input name="login" type="submit" id="login" value="Login">
				</p>
				
			</form>
		</div>
	</body>
</html>