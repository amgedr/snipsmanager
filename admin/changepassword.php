<?php
session_start();
include('../config.php');
include('../includes/functions.php');
connect();

include('header.php');

require('../includes/login.class.php');
$loginSys = new LoginSystem();

//if not logged in goto login form, otherwise we can view our page
if(!$loginSys->isLoggedIn()) {
	header("Location: login.php");
	exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(empty($_POST['password']) | empty($_POST['password1']) | empty($_POST['password2'])) {
		$error_message = 'Please fill all fields.';
	}
	else {
		$oldpassword = $loginSys->clean($_POST['password']);
		$newpassword1 = $loginSys->clean($_POST['password1']);
		$newpassword2 = $loginSys->clean($_POST['password2']);

		if($newpassword1 != $newpassword2) {
			$error_message = 'The new password fields do not match.';
		}
		else {
			if(!$loginSys->checkPassword($_POST['password'])) {
				$error_message="Please enter the correct current password.";
			}
			else {
				if(!$loginSys->changePassword($newpassword1)) {
					$error_message = 'Could not change password. Please try again.';
				}
			}
		}
	}
}
?>

	<div class='sub'>
    	<span>Logged in as <?php echo  $_SESSION['userName']; ?>&nbsp;&nbsp;
    	<a href="changepassword.php">Change Password</a>&nbsp;&nbsp;
    	<a href="../includes/logout.php">Logout</a></span>
        General Settings</div>
	<div class='content'>

<?php if(!empty($error_message)) { ?>
		<div id="error" style="display:block;"><?php echo $error_message; ?></div>
<?php } ?>
        <div class='top'></div>
        <center>
            <div class='textbox2' name="gottaload"> <br />
                <form method="post" name="form1" >
                    <center>
                        <table class="fieldstable" style="width: 350px;">
                            <tr>
                                <td width="120px"><strong>Current Password:</strong></td>
                                <td><input name="password" type="password" style="width:200px" /></td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                                <td>&nbsp;</td>
                            <tr>
                                <td><strong>New Password:</strong></td>
                                <td><input name="password1" type="password" style="width:200px" /></td>
                            </tr>
                            <tr>
                                <td><strong>Retype Password:</strong></td>
                                <td><input name="password2" type="password" style="width:200px" /></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td style="padding-left:125px;">
                                	<input type="submit" value="Change" style="width:80px;" class="button orange"/></td>
                            </tr>
                        </table>
                    </center>
                </form>
            </div>
        </center>
        <div class='bottom'></div>

<?php include("footer.php"); ?>