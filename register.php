<?php
	// connect to db
	require_once( './includes/connection.inc.php' );
	require_once( './includes/recaptchalib.inc.php' );
	
	$dbc = mysqli_connect( DB_HOST, DB_USER, DB_PASS, DB_NAME ) or die('Could not connect to database');
	
	if ( isset( $_POST['register'] ) ) {
		
		$email = mysqli_real_escape_string( $dbc, trim( $_POST['email'] ) );
		$username = mysqli_real_escape_string( $dbc, trim( $_POST['username'] ) );
		$firstname = mysqli_real_escape_string( $dbc, trim( $_POST['first_name'] ) );
		$lastname = mysqli_real_escape_string( $dbc, trim( $_POST['last_name'] ) );
		$password = mysqli_real_escape_string( $dbc, trim( $_POST['pwd'] ) );
		$retyped = mysqli_real_escape_string( $dbc, trim( $_POST['conf_pwd'] ) );
		require_once( './includes/register.inc.php' );

	}
	
	require_once( './includes/title.inc.php' );
	require_once( './includes/header.inc.php' );
	require_once( './includes/logo.inc.php' );
	require_once( './includes/nav_menu.inc.php' );
	
	echo 'h1>Register for the Ultimate Grind Personalized warm-up</h1>';

	if( isset( $errors ) && !empty( $errors ) ) {
		
		echo '<ul>';
		foreach( $errors as $error ) {
			echo "<li class='error'>$error</li>";
		}
		echo '</ul>';
		
	}
	?>
	<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		
		<p>
		    <label for="email">Email:</label>
		    <input type="text" name="email" id="email" value="<?php if( !empty( $email ) ) echo $email; ?>" required >
		</p>
		
		<p>
		    <label for="username">Username:</label>
		    <input type="text" name="username" id="username" value="<?php if( !empty( $username ) ) echo $username; ?>" required >
		</p>
		
		<p>
		    <label for="first_name">First Name:</label>
		    <input type="text" name="first_name" id="first_name" value="<?php if( !empty( $firstname ) ) echo $firstname; ?>" required >
		</p>
		
		<p>
		    <label for="last_name">Last Name:</label>
		    <input type="text" name="last_name" id="last_name" value="<?php if( !empty( $lastname ) ) echo $lastname; ?>" required >
		</p>
		
		<p>
		    <label for="pwd">Password:</label>
		    <input type="password" name="pwd" id="pwd" required >
		</p>
		
		<p>
		    <label for="conf_pwd">Confirm password:</label>
		    <input type="password" name="conf_pwd" id="conf_pwd" required >
		</p>
			<?php
    		echo recaptcha_get_html( PUBLIC_KEY );
    		?>
		<p>
			<input name="register" type="submit" id="register" value="Register" >
		</p>
		
	</form>
<?php
	require_once( './includes/footer.inc.php' );
?>