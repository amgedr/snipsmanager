<?php
session_start();
include('../config.php');
include('../includes/functions.php');
connect();

require('../includes/login.class.php');
$loginSys = new LoginSystem();

//if not logged in goto login form, otherwise we can view our page
if(!$loginSys->isLoggedIn()) {
	header("Location: login.php");
	exit;
}

include('header.php');

?>

	<div class='sub'>
	    <span>Logged in as <?php echo  $_SESSION['userName']; ?>&nbsp;&nbsp;
    	<a href="changepassword.php">Change Password</a>&nbsp;&nbsp;
    	<a href="../includes/logout.php">Logout</a></span>
    	Home</div>

	<div class='content'>
		<div id='error'></div>

<div class='top'></div>
<center>

<script type="text/javascript" src="../includes/ofc/js/swfobject.js"></script>
<script type="text/javascript">
	swfobject.embedSWF("../includes/ofc/open-flash-chart.swf", "admin_days", "575", "300", "9.0.0", "../includes/expressInstall.swf", {"data-file":"../includes/ofc/charts/admin_days.php"});
</script>
<script type="text/javascript">
	swfobject.embedSWF("../includes/ofc/open-flash-chart.swf", "admin_types", "575", "300", "9.0.0", "../includes/expressInstall.swf", {"data-file":"../includes/ofc/charts/admin_types.php"});
</script>

<div class='textbox2' name="gottaload">

<div id="usual1" class="tabnames">
  <ul>
    <li><a class="selected" href="#days">Days</a></li>
    <li><a href="#types">Types</a></li>
    <li style="float:right;font-weight:bold;padding-top:6px;"><?php echo ch_gettotalsnippets(); ?> Total Snippets</li>
  </ul>
  <div id="days"><br /><br /><div id="admin_days"></div></div>
  <div id="types"><br /><br /><div id="admin_types"></div></div>
</div>

<script type="text/javascript">
  $("#usual1 ul").idTabs();
</script>

</div>
<div class='bottom'></div>
</center>

<?php include("footer.php"); ?>