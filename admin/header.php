<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="robots" content="noindex" />
<meta name="robots" content="nofollow" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="css/reset.css" />
<link rel="stylesheet" href="css/style.css" /> 

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="/codehave/admin/js/jquery-impromptu.3.1.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<style>
	.tablerow {
		padding-left:3px;
		border:1px solid #999;
		vertical-align:middle;
	}
	.tabletitle {
		background-color:#D9EAF3;
		padding-left:3px;
		border:1px solid #999;
		vertical-align:middle;
	}
	.tablenav {
		text-align:center;
		vertical-align:middle;
		font-weight:bold;
	}
	.checkboxes { }
	
	/*-------------impromptu---------- */
	.jqifade{ position: absolute; background-color: #aaaaaa; }
	div.jqi{ width: 700px; height: 450px; font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; position: absolute; background-color:#eee ; font-size: 11px; text-align: left; border: solid 1px #eeeeee; -moz-border-radius: 10px; -webkit-border-radius: 10px; padding: 7px; }
	div.jqi .jqicontainer{ font-weight: bold; }
	div.jqi .jqiclose{ position: absolute; top: 4px; right: -2px; width: 18px; cursor: default; color: #bbbbbb; font-weight: bold; }
	div.jqi .jqimessage{ padding: 5px; line-height: 20px; color: #444444; }
	div.jqi .jqibuttons{ text-align: right; padding: 5px 0 5px 0; }
	div.jqi button{ padding: 3px 10px; margin: 0 10px; background-color: #2F6073; border: solid 1px #f4f4f4; color: #ffffff; font-weight: bold; font-size: 12px; }
	div.jqi button:hover{ background-color: #728A8C; }
	div.jqi button.jqidefaultbutton{ background-color: #BF5E26; }
	.jqiwarning .jqi .jqibuttons{ background-color: #BF5E26; }
	
	div.jqi #codetitle { font-size:16px; width:99%; border:1px solid #999; margin-bottom: 15px;}
	div.jqi #codeview { height:310px; border:1px solid #999; padding:5px; overflow:auto; background-color:#ffffff; width:98%; }
	
	div.jqi .jqimessage .field{ padding: 5px 0; }
	div.jqi .jqimessage .field label{ display: block; clear: left; float: left; width: 100px; }
	div.jqi .jqimessage .field input{ width: 150px; border: solid 1px #777777; }
	div.jqi .jqimessage .field input.error{ width: 150px; border: solid 1px #ff0000; }
	/*-------------------------------- */

</style>

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
    	<li><a href="index.php">Home</a></li>
		<li><a href="settings.php">Settings</a></li>
        <li><a href="moderate.php">Moderate</a></li>
        <li><a href="news.php">News</a></li>
	</ul>
    <?php } ?>
	<a href="../index.php"><img src="images/logo.png" title="Home" alt="CodeHave"/></a>
</div>
