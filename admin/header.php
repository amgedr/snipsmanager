<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="robots" content="noindex" />
<meta name="robots" content="nofollow" />

<link rel="stylesheet" href="css/reset.css" />
<link rel="stylesheet" href="css/style.css" /> 

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/main.js"></script>

<meta name="generator" content="CodeHave <?php echo ch_getsetting('version'); ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CodeHave Admin</title>
</head>
<body>

<div class='header'>
	<?php  
		//hide the menu if the page is login.php or forgotpassword.php
		$filename = basename($_SERVER['PHP_SELF']);		
		if($filename != "login.php" & $filename != "forgotpassword.php") {
	?>
	<ul>
		<li><a href="index.php">General</a></li>
        <li><a href="interface.php">Interface</a></li>		
	</ul>
    <?php } ?>
	<a href="../index.php"><img src="images/logo.png" title="Home" alt="CodeHave"/></a>
</div>
