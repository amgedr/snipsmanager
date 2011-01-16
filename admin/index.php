<?php 
session_start(); 
include('../config.php');
include('../includes/functions.php');
connect();

include('header.php'); 

require('../includes/login.class.php');
$loginSys = new LoginSystem();

// if not logged in goto login form, otherwise we can view our page
if(!$loginSys->isLoggedIn()) {
	header("Location: login.php");
	exit;
}?>

	<div class='sub'>
	    <span>Logged in as <?php echo  $_SESSION['userName']; ?>&nbsp;&nbsp;
    	<a href="changepassword.php">Change Password</a>&nbsp;&nbsp;
    	<a href="../includes/logout.php">Logout</a></span>
    	Home</div>

	<div class='content'>
		<div id='error'></div>

<div class='top'></div>
<center><div class='textbox2' name="gottaload">





</div></center>
   <div class='bottom'></div>


<?php include("footer.php"); ?>