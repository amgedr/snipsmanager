<?php
session_start();
include('../config.php');
include('../includes/functions.php');
connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if((!$_POST['username']) || (!$_POST['password'])) {
		// display error message
		header('location: login.php');// show error
		exit;
	}

	require('../includes/login.class.php');
	$loginSystem = new LoginSystem();
	if($loginSystem->doLogin($_POST['username'],$_POST['password'])) {
		header('location: index.php');  // Redirect to secure page
	}
	else {
		header('location: login.php');
		exit;
	}
}

include('header.php');
?>

<div class='work'>
    <div class='sub'>Admin Log In</div>
    <div class='content'>
        <div id='error'>
        </div>
        <div class='top'></div>
        <center>
            <div class='textbox2' name="gottaload"> <br />
                <form method="post" name="form1" action="login.php">
                    <center>
                        <table class="fieldstable" style="width: 300px;">
                            <tr>
                                <td width="80px"><strong>Username:</strong></td>
                                <td><input name="username" type="text" style="width:203px" /></td>
                            </tr>
                            <tr>
                                <td><strong>Password:</strong></td>
                                <td><input name="password" type="password" style="width:203px" /></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td style="text-align:right; padding-right:12px;">
                                	<div style="float:left;"><a href="forgotpassword.php">Forgot password</a></div>
	                                <input type="submit" value="Login" class="button orange light" /></td>
                            </tr>
                        </table>
                    </center>
                </form>
            </div>
        </center>
        <div class='bottom'></div>
<?php include('footer.php'); ?>