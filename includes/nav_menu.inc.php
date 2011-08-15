<ul id="nav">
	<?php // generate the nav menu <li><a href="logout.inc.php">Logout:</a></li>
	if( isset( $_SESSION['username'] ) ) { ?>
		<li><a href="index.php" <?php if ($currentPage == 'index.php'){echo 'id="here"';} ?>>Home:</a></li>
		<li><a href="assessment_form.php" <?php if ($currentPage == 'assessment_form.php'){echo 'id="here"';} ?>>Assessment Form:</a></li>
		<li><a href="recent_warmups.php" <?php if ($currentPage == 'recent_warmups.php'){echo 'id="here"';} ?>>Recent Warm ups:</a></li>
		<li><a href="logout.php">Log Out:<?php echo ' (' . $_SESSION['username'] . ')'; ?></a></li>
	<?php } else { ?>
		<li><a href="login.php" <?php if ($currentPage == 'login.php'){echo 'id="here"';} ?>>Login:</a></li>
		<li><a href="register.php" <?php if ($currentPage == 'register.php'){echo 'id="here"';} ?>>Register:</a></li>
	<?php } ?>
</ul>