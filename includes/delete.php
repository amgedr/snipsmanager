<?php
session_start();
include('../config.php');
include('../includes/functions.php');
connect();

require('../includes/login.class.php');
$loginSys = new LoginSystem();

// if not logged in goto login form, otherwise we can view our page
if(!$loginSys->isLoggedIn()) {
	header("Location: login.php");
	exit;
}

if(!empty($_POST['id']))
	mysql_query("DELETE FROM `codes` WHERE `id`=" . $_POST['id']);

?>
