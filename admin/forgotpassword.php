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
 * Forgot password page for admins. Uses kaptcha verification.
 *
 */
 
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