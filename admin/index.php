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

include('header.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){	
	ch_savesetting('title', $_POST['sitetitle']);
	ch_savesetting('slogan', $_POST['slogan']);
	ch_savesetting('logourl', $_POST['logourl']);
	ch_savesetting('metadescription', $_POST['metadescription']);
	ch_savesetting('metakeywords', $_POST['metakeywords']);
	ch_savesetting('ownername', $_POST['ownername']);
	ch_savesetting('owneremail', $_POST['owneremail']);
}

?>

	<div class='sub'>
    	<span>Logged in as <?php echo  $_SESSION['userName']; ?>&nbsp;&nbsp;
    	<a href="changepassword.php">Change Password</a>&nbsp;&nbsp;
    	<a href="../includes/logout.php">Logout</a></span>
        General Settings</div>
	<div class='content'>
		<div id='error'></div>

<div class='top'></div>
<center><div class='textbox2' name="gottaload">
<form method="post" name="form1">
<table>
<tr>
    <td width="160px">Title:</td>
    <td><input type="text" name="sitetitle" style="width: 430px;" value="<?php echo ch_getsetting('title'); ?>" /></td>
</tr>
<tr>
    <td>Slogan:</td>
    <td><input type="text" name="slogan" style="width: 430px;" value="<?php echo ch_getsetting('slogan'); ?>" /></td>
</tr>
<tr>
    <td>Logo URL:</td>
    <td><input type="text" name="logourl" style="width: 430px;" value="<?php echo ch_getsetting('logourl'); ?>" /></td>
</tr>
<tr style="height:81px;">
    <td style="vertical-align:top; padding-top:5px;">META Description:</td>
    <td><textarea name="metadescription" rows="3"><?php echo ch_getsetting('metadescription'); ?></textarea></td>
</tr>
<tr>
    <td style="vertical-align:top; padding-top:5px;">META Keywords:</td>
    <td><textarea name="metakeywords" rows="2"><?php echo ch_getsetting('metakeywords'); ?></textarea></td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td></td>
</tr>
<tr>
    <td>Your Name:</td>
    <td><input type="text" name="ownername" style="width: 430px;" value="<?php echo ch_getsetting('ownername'); ?>" /></td>
</tr>
<tr>
    <td>Your Email:</td>
    <td><input type="text" name="owneremail" style="width: 430px;" value="<?php echo ch_getsetting('owneremail'); ?>" /></td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td></td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td style="text-align:right;"><input type="submit" value="Submit" /></td>
</tr>
</table>	
</form>
</div></center>
   <div class='bottom'></div>
<?php include('footer.php'); ?>