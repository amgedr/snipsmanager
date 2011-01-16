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
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){	
	if(!empty($_POST['item1text']) & !empty($_POST['item1url'])) {
		ch_savesetting('topmenu1text', $_POST['item1text']);
		ch_savesetting('topmenu1url', $_POST['item1url']);
	}
	else {
		ch_savesetting('topmenu1text', '');
		ch_savesetting('topmenu1url', '');
	}
	
	if(!empty($_POST['item2text']) & !empty($_POST['item2url'])) {
		ch_savesetting('topmenu2text', $_POST['item2text']);
		ch_savesetting('topmenu2url', $_POST['item2url']);
	}
	else {
		ch_savesetting('topmenu2text', '');
		ch_savesetting('topmenu2url', '');
	}
	
	if(!empty($_POST['item3text']) & !empty($_POST['item3url'])) {
		ch_savesetting('topmenu3text', $_POST['item3text']);
		ch_savesetting('topmenu3url', $_POST['item3url']);
	}
	else {
		ch_savesetting('topmenu3text', '');
		ch_savesetting('topmenu3url', '');
	}
	
	if(!empty($_POST['item4text']) & !empty($_POST['item4url'])) {
		ch_savesetting('topmenu4text', $_POST['item4text']);
		ch_savesetting('topmenu4url', $_POST['item4url']);
	}
	else {
		ch_savesetting('topmenu4text', '');
		ch_savesetting('topmenu4url', '');
	}	
	
	ch_savesetting('iconset', $_POST['sbfolders']);
}
?>

	<div class='sub'>
	    <span>Logged in as <?php echo  $_SESSION['userName']; ?>&nbsp;&nbsp;
    	<a href="changepassword.php">Change Password</a>&nbsp;&nbsp;
    	<a href="../includes/logout.php">Logout</a></span>
    	Interface Settings</div>

	<div class='content'>
		<div id='error'></div>


<div class='top'></div>   
<center><div class='textbox2' name="gottaload">
<form method="post" name="form1" id="form1">
<table>
<tr>
	<td style="width:115px;"><strong>Menu Item 1</strong></td>
    <td style="width:45px;">Text:</td>
    <td><input type="text" name="item1text" value="<?php echo ch_getsetting('topmenu1text'); ?>" /></td>
</tr>
<tr>
	<td></td>
    <td>URL:</td>
    <td><input type="text" name="item1url" value="<?php echo ch_getsetting('topmenu1url'); ?>" /></td>
</tr>
<tr>
	<td><strong>Menu Item 2</strong></td>
    <td>Text:</td>
    <td><input type="text" name="item2text" value="<?php echo ch_getsetting('topmenu2text'); ?>" /></td>
</tr>
<tr>
	<td></td>
    <td>URL:</td>
    <td><input type="text" name="item2url" value="<?php echo ch_getsetting('topmenu2url'); ?>" /></td>
</tr>
<tr>
	<td><strong>Menu Item 3</strong></td>
    <td>Text:</td>
    <td><input type="text" name="item3text" value="<?php echo ch_getsetting('topmenu3text'); ?>" /></td>
</tr>
<tr>
	<td></td>
    <td>URL:</td>
    <td><input type="text" name="item3url" value="<?php echo ch_getsetting('topmenu3url'); ?>" /></td>
</tr>
<tr>
	<td><strong>Menu Item 4</strong></td>
    <td>Text:</td>
    <td><input type="text" name="item4text" value="<?php echo ch_getsetting('topmenu4text'); ?>" /></td>
</tr>
<tr>
	<td></td>
    <td>URL:</td>
    <td><input type="text" name="item4url" value="<?php echo ch_getsetting('topmenu4url'); ?>" /></td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td></td>
</tr>
<tr>
    <td style="padding-top: 7px; vertical-align:top;" colspan="2">Social Bookmarks:</td>
    <td><div style="padding-top:7px; width:110px; float:left;"><?php echo ch_getsocialbookmarksfolders(); ?></div>&nbsp;
    <div id="sbicons" style="height: 32px; width:300px; float:right; text-align:center;"><?php echo ch_displaysocialbookmarksonly(); ?></div></td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td></td>
    <td style="text-align:right;"><input type="submit" value="Submit" /></td>
</tr>
</table>
</form>
</div></center>
   <div class='bottom'></div>

<?php include('footer.php');?>