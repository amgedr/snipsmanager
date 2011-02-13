<?php 
/**
 * Copyright (c) 2010-2011 SnipsManager (http://www.snipsmanager.com/), All Rights Reserved
 * A CodeHill Creation (http://codehill.com/)
 * 
 * IMPORTANT: 
 * - You may not redistribute, sell or otherwise share this software in whole or in part without
 *   the consent of SnipsManager's owners. Please contact the author for more information.
 * 
 * - Link to snipsmanager.com may not be removed from the software pages without permission of SnipsManager's
 *   owners. This copyright notice may not be removed from the source code in any case.
 *
 * - This file can be used, modified and distributed under the terms of the License Agreement. You
 *   may edit this file on a licensed Web site and/or for private development. You must adhere to
 *   the Source License Agreement. The latest copy can be found online at:
 * 
 *   http://www.snipsmanager.com/license/
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR 
 * IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND 
 * FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR 
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, 
 * WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY
 * WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @link        http://www.snipsmanager.com/
 * @copyright   2010-2011 CodeHill LLC (http://codehill.com/)
 * @license     http://www.snipsmanager.com/license/
 * @author      Amgad Suliman, CodeHill LLC <amgadhs@codehill.com>
 * @version     2.2
 *
 * Admin's change password form.
 *
 */
 
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
                        <table style="width: 350px;">
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
                                <td style="padding-left:120px;">
                                	<input type="submit" value="Change" style="width:80px;" /></td>
                            </tr>
                        </table>
                    </center>
                </form>
            </div>
        </center>
        <div class='bottom'></div>

<?php include("footer.php"); ?>