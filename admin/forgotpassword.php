<?php
session_start(); 
include('../config.php');
include('../includes/functions.php');
connect();

include('header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {	
	if(empty($_POST['username']) || empty($_POST['captcha'])) {		
		$error_message = 'Please fill all fields.';
	}
	else {
		if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] ==  $_POST['captcha']){
			require('../includes/login.class.php');
			if(LoginSystem::forgotpassword($_POST['username'])) {
				$error_message = "A new password was created for user " . $_POST['username'] . ".";
			}
			else {
				$error_message = "An error occurred. Please check the username and submit again.";
			}
		}else{
			$error_message = "Please enter exactly what you see in the image below.";
		}		
	}
}

?>

<div class='work'>

    <div class='sub'>Password Retrieval Form</div>
    <div class='content'>
<?php if(!empty($error_message)) { ?>
		<div id="error" style="display:block;"><?php echo $error_message; ?></div>
<?php } ?>
        <div class='top'></div>
        <center>
            <div class='textbox2' name="gottaload"> <br />
                <form method="post" name="form1" action="forgotpassword.php">
                    <center>
                        <table style="width: 280px; text-align:left;">
                            <tr style="height:40px">
                                <td width="85px"><strong>Username:</strong></td>
                                <td><input name="username" type="text" style="width:171px" /></td>
                            </tr>
                            <tr>
                                <td><strong>Verification:</strong></td>
                                <td><input name="captcha" type="text" style="width:171px" /></td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                                <td style="height:70px;"><img src="../includes/kcaptcha/index.php?<?php echo session_name() ."=". session_id()?>" width="175" height="60" /></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td style="padding-left:100px;">
	                                <input type="submit" value="Submit" style="width:80px;" /></td>
                            </tr>    
                        </table>
                    </center>
                </form>
            </div>
        </center>
        <div class='bottom'></div>
<?php include('footer.php'); ?>