<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>The Ultimate Grind<?php if( isset( $title ) ) {echo "&#8212;{$title}";} ?></title>
		<link rel="stylesheet" href="./styles/ug.css" />
		<link rel="shortcut icon" href="./favicon.ico" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script> 
        <script type="text/javascript" src="../js/javascript.js"></script> 
		<?php
			if( $currentPage == 'register.php' ) { ?>
				<script type="text/javascript">
					var RecaptchaOptions = {
						theme : 'clean'
					};
				</script>
		<?php } ?>
	</head>
	
	<body>
		<div id="mainContent">