<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="shortcut icon" href="../favicon.ico" />

	<meta name="robots" content="noindex" />
	<meta name="robots" content="nofollow" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<link rel="stylesheet" href="css/reset.css" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/buttons.css" />

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery-impromptu.3.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.idTabs.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>

	<meta name="generator" content="SnipsManager <?php echo ch_getsetting('version'); ?>" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SnipsManager Admin</title>
</head>
<body>

<div class='header'>
	<?php
		//hide the menu if the page is login.php or forgotpassword.php
		$filename = basename($_SERVER['PHP_SELF']);
		if($filename != "login.php" & $filename != "forgotpassword.php") {
	?>
	<ul>
    	<li><a href="index.php">Home</a></li>
		<li><a href="settings.php">Settings</a></li>
        <li><a href="moderate.php">Moderate</a></li>
        <li><a href="news.php">News</a></li>
	</ul>
    <?php } ?>
	<a href="../index.php"><img src="images/snipsmanager.png" title="Home" alt="SnipsManager"/></a>
</div>