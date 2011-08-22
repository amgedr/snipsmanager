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
 * Admin area login page.
 *
 */
 
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
                        <table style="width: 300px;">
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
	                                <input type="submit" value="Login" class="button orange" /></td>
                            </tr>    
                        </table>
                    </center>
                </form>
            </div>
        </center>
        <div class='bottom'></div>
<?php include('footer.php'); ?>