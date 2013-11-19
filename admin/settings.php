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
        Settings</div>
	<div class='content'>
		<div id='error'></div>

<div class='top'></div>
<center><div class='textbox2' name="gottaload">
<form method="post" name="form1">

<div id="usual1" class="tabnames" style="height:400px;">
    <ul>
        <li><a class="selected" href="#general">General</a></li>
        <li><a href="#interface">Interface</a></li>
    </ul>
	<br />
    <div id="general"><br /><br />
        <table class="fieldstable">
            <tr>
                <td width="160px">Title:</td>
                <td>
					<input type="text" id="sitetitle" name="sitetitle" style="width: 430px;"
						   value="<?php echo ch_getsetting('title'); ?>" />
				</td>
            </tr>
            <tr>
                <td>Slogan:</td>
                <td>
					<input type="text" id="slogan" name="slogan" style="width: 430px;"
						   value="<?php echo ch_getsetting('slogan'); ?>" />
				</td>
            </tr>
            <tr>
                <td>Logo URL:</td>
                <td>
					<input type="text" id="logourl" name="logourl" style="width: 430px;"
						   value="<?php echo ch_getsetting('logourl'); ?>" />
				</td>
            </tr>
            <tr style="height:81px;">
                <td style="vertical-align:top; padding-top:5px;">META Description:</td>
                <td>
					<textarea id="metadescription" name="metadescription" rows="3"><?php echo ch_getsetting('metadescription'); ?>
					</textarea>
				</td>
            </tr>
            <tr>
                <td style="vertical-align:top; padding-top:5px;">META Keywords:</td>
                <td>
					<textarea id="metakeywords" name="metakeywords" rows="2"><?php echo ch_getsetting('metakeywords'); ?>
					</textarea>
				</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
            </tr>
            <tr>
                <td>Your Name:</td>
                <td>
					<input type="text" id="ownername" name="ownername" style="width: 430px;"
						   value="<?php echo ch_getsetting('ownername'); ?>" />
				</td>
            </tr>
            <tr>
                <td>Your Email:</td>
                <td>
					<input type="text" id="owneremail" name="owneremail" style="width: 430px;"
						   value="<?php echo ch_getsetting('owneremail'); ?>" />
				</td>
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
        <table class="fieldstable">
            <tr>
                <td style="width:115px;"><strong>Menu Item 1</strong></td>
                <td style="width:45px;">Text:</td>
                <td>
					<input type="text" id="item1text" name="item1text"
						   value="<?php echo ch_getsetting('topmenu1text'); ?>" />
				</td>
            </tr>
            <tr>
                <td></td>
                <td>URL:</td>
                <td>
					<input type="text" id="item1url" name="item1url"
						   value="<?php echo ch_getsetting('topmenu1url'); ?>" />
				</td>
            </tr>
            <tr>
                <td><strong>Menu Item 2</strong></td>
                <td>Text:</td>
                <td>
					<input type="text" id="item2text" name="item2text"
						   value="<?php echo ch_getsetting('topmenu2text'); ?>" />
				</td>
            </tr>
            <tr>
                <td></td>
                <td>URL:</td>
                <td>
					<input type="text" id="item2url" name="item2url"
						   value="<?php echo ch_getsetting('topmenu2url'); ?>" />
				</td>
            </tr>
            <tr>
                <td><strong>Menu Item 3</strong></td>
                <td>Text:</td>
                <td>
					<input type="text" id="item3text" name="item3text"
						   value="<?php echo ch_getsetting('topmenu3text'); ?>" />
				</td>
            </tr>
            <tr>
                <td></td>
                <td>URL:</td>
                <td>
					<input type="text" id="item3url" name="item3url"
						   value="<?php echo ch_getsetting('topmenu3url'); ?>" />
				</td>
            </tr>
            <tr>
                <td><strong>Menu Item 4</strong></td>
                <td>Text:</td>
                <td>
					<input type="text" id="item4text" name="item4text"
						   value="<?php echo ch_getsetting('topmenu4text'); ?>" />
				</td>
            </tr>
            <tr>
                <td></td>
                <td>URL:</td>
                <td>
					<input type="text" id="item4url" name="item4url"
						   value="<?php echo ch_getsetting('topmenu4url'); ?>" />
				</td>
            </tr>
        </table>
    </div>
</div>

<script type="text/javascript">
  $("#usual1 ul").idTabs();
</script>


<div style="text-align:right;">
	<a href="javascript:void(0);" onClick="saveallsettings();" class="button orange">Submit</a>
</div>
</form>
</div></center>
   <div class='bottom'></div>
<?php include('footer.php'); ?>