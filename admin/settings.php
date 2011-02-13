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
 * The Settings page. Admins can change general and interface settings from here.
 *
 */
 
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
        Settings</div>
	<div class='content'>
		<div id='error'></div>

<div class='top'></div>
<center><div class='textbox2' name="gottaload">
<form method="post" name="form1">

<div id="usual1" class="tabnames" style="height:380px;"> 
    <ul> 
        <li><a class="selected" href="#general">General</a></li> 
        <li><a href="#interface">Interface</a></li>
    </ul>
    <div id="general"><br /><br />
        <table>
            <tr>
                <td width="160px">Title:</td>
                <td><input type="text" id="sitetitle" name="sitetitle" style="width: 430px;" value="<?php echo ch_getsetting('title'); ?>" /></td>
            </tr>
            <tr>
                <td>Slogan:</td>
                <td><input type="text" id="slogan" name="slogan" style="width: 430px;" value="<?php echo ch_getsetting('slogan'); ?>" /></td>
            </tr>
            <tr>
                <td>Logo URL:</td>
                <td><input type="text" id="logourl" name="logourl" style="width: 430px;" value="<?php echo ch_getsetting('logourl'); ?>" /></td>
            </tr>
            <tr style="height:81px;">
                <td style="vertical-align:top; padding-top:5px;">META Description:</td>
                <td><textarea id="metadescription" name="metadescription" rows="3"><?php echo ch_getsetting('metadescription'); ?></textarea></td>
            </tr>
            <tr>
                <td style="vertical-align:top; padding-top:5px;">META Keywords:</td>
                <td><textarea id="metakeywords" name="metakeywords" rows="2"><?php echo ch_getsetting('metakeywords'); ?></textarea></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
            </tr>
            <tr>
                <td>Your Name:</td>
                <td><input type="text" id="ownername" name="ownername" style="width: 430px;" value="<?php echo ch_getsetting('ownername'); ?>" /></td>
            </tr>
            <tr>
                <td>Your Email:</td>
                <td><input type="text" id="owneremail" name="owneremail" style="width: 430px;" value="<?php echo ch_getsetting('owneremail'); ?>" /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td style="text-align:right;"></td>
            </tr>
        </table>
    </div> 
    <div id="interface"><br /><br />
        <table>
            <tr>
                <td style="width:115px;"><strong>Menu Item 1</strong></td>
                <td style="width:45px;">Text:</td>
                <td><input type="text" id="item1text" name="item1text" value="<?php echo ch_getsetting('topmenu1text'); ?>" /></td>
            </tr>
            <tr>
                <td></td>
                <td>URL:</td>
                <td><input type="text" id="item1url" name="item1url" value="<?php echo ch_getsetting('topmenu1url'); ?>" /></td>
            </tr>
            <tr>
                <td><strong>Menu Item 2</strong></td>
                <td>Text:</td>
                <td><input type="text" id="item2text" name="item2text" value="<?php echo ch_getsetting('topmenu2text'); ?>" /></td>
            </tr>
            <tr>
                <td></td>
                <td>URL:</td>
                <td><input type="text" id="item2url" name="item2url" value="<?php echo ch_getsetting('topmenu2url'); ?>" /></td>
            </tr>
            <tr>
                <td><strong>Menu Item 3</strong></td>
                <td>Text:</td>
                <td><input type="text" id="item3text" name="item3text" value="<?php echo ch_getsetting('topmenu3text'); ?>" /></td>
            </tr>
            <tr>
                <td></td>
                <td>URL:</td>
                <td><input type="text" id="item3url" name="item3url" value="<?php echo ch_getsetting('topmenu3url'); ?>" /></td>
            </tr>
            <tr>
                <td><strong>Menu Item 4</strong></td>
                <td>Text:</td>
                <td><input type="text" id="item4text" name="item4text" value="<?php echo ch_getsetting('topmenu4text'); ?>" /></td>
            </tr>
            <tr>
                <td></td>
                <td>URL:</td>
                <td><input type="text" id="item4url" name="item4url" value="<?php echo ch_getsetting('topmenu4url'); ?>" /></td>
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
        </table>    
    </div> 
</div> 
 
<script type="text/javascript"> 
  $("#usual1 ul").idTabs(); 
</script>


<div style="text-align:right;"><a href="javascript:void(0);" onClick="saveallsettings();">Submit</a></div>
</form>
</div></center>
   <div class='bottom'></div>
<?php include('footer.php'); ?>