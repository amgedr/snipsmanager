<?php
/**
 * Copyright (c) 2010-2011 CodeHave (http://www.codehave.com/), All Rights Reserved
 * A CodeHill Creation (http://codehill.com/)
 * 
 * IMPORTANT: 
 * - You may not redistribute, sell or otherwise share this software in whole or in part without
 *   the consent of CodeHave's owners. Please contact the author for more information.
 * 
 * - Link to codehave.com may not be removed from the software pages without permission of CodeHave's
 *   owners. This copyright notice may not be removed from the source code in any case.
 *
 * - This file can be used, modified and distributed under the terms of the License Agreement. You
 *   may edit this file on a licensed Web site and/or for private development. You must adhere to
 *   the Source License Agreement. The latest copy can be found online at:
 * 
 *   http://www.codehave.com/license/
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
 * @link        http://www.codehave.com/
 * @copyright   2010-2011 CodeHill LLC (http://codehill.com/)
 * @license     http://www.codehave.com/license/
 * @author      Amgad Suliman, CodeHill LLC <amgadhs@codehill.com>
 * @version     2.2
 *
 * Installation page.
 *
 */
 
if(isset($_POST['mysql_username'])){
	try {
		$complete = false;

		$username = $_POST['mysql_username'];
		$password = $_POST['mysql_password'];
		$database = $_POST['mysql_db'];
		$server   = $_POST['mysql_server'];
		
		//---------- Validation Checks
		if(empty($username))
			throw new Exception("You must enter a the username.");
				
		if(empty($database))
			throw new Exception("You must enter a database name.");
				
		if(empty($server))
			throw new Exception("You must enter the server name.");
		
		//---------- Database Check/Connection
		$connection = @mysql_connect($server,$username,$password);
		if($connection == false)
			throw new Exception('Some of the information you entered is incorrect.');
				
		$test = @mysql_select_db($database);		
		if($test == false) 
			throw new Exception('bad database name');
		
		//---------- Everything went well. Run the CREATE query and display a message to the user
		//create table admin
		mysql_query("CREATE TABLE IF NOT EXISTS `admins` (`UserName` varchar(20) NOT NULL," .
			"`Password` varchar(32) NOT NULL, PRIMARY KEY (`UserName`)" .
			") ENGINE=MyISAM DEFAULT CHARSET=latin1;") or 
			die("Could not create admin table. Error: " . mysql_error());		
	
		//insert admin user in table admin with password admin		
		mysql_query("INSERT INTO `admins` (`UserName`, `Password`) VALUES (" . 
			"'admin', '21232f297a57a5a743894a0e4a801fc3');") or 
			die("Could not insert records in table admin. Error: " . mysql_error());

		//create table codes
		mysql_query("CREATE TABLE IF NOT EXISTS `codes` (`code` mediumtext," .
			" `type` varchar(255) DEFAULT NULL, `id` int(27) NOT NULL AUTO_INCREMENT," .
			" `password` varchar(255) DEFAULT NULL, `codetitle` varchar(200) NOT NULL," .
			" `submitdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,  PRIMARY KEY (`id`)" . 
			") ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93;") or 
			die("Could not create codes table. Error: " . mysql_error());

		//create table settings
		mysql_query("CREATE TABLE IF NOT EXISTS `settings` (" . 
			"`settingid` bigint(20) unsigned NOT NULL AUTO_INCREMENT, `settingname` varchar(50) NOT NULL," .
			" `settingvalue` varchar(300) NOT NULL, UNIQUE KEY `settingid` (`settingid`)" .
			") ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;") or 
			die("Could not create setting table. Error: " . mysql_error());

		//insert default settings into the settings table
		mysql_query("INSERT INTO `settings` (`settingid`, `settingname`, `settingvalue`) VALUES " .
			"(1, 'version', '2.0'), " .
			"(2, 'title', 'CodeHave'), " .
			"(5, 'slogan', 'Share the code!'), " .
			"(6, 'metadescription', 'A code sharing website.'), " .
			"(17, 'iconset', '2'), " .
			"(7, 'metakeywords', 'code sharing, text sharing'), " .
			"(8, 'logourl', 'images/logo.png'), " .
			"(9, 'topmenu1text', 'Home'), " .
			"(10, 'topmenu1url', 'index.php'), " .
			"(11, 'topmenu2text', 'Contact'), " .
			"(12, 'topmenu2url', 'contact.php'), " .
			"(13, 'topmenu3text', ''), " .
			"(14, 'topmenu3url', ''), " .
			"(15, 'topmenu4text', ''), " .
			"(16, 'topmenu4url', ''), " .
			"(18, 'ownername', ''), " .
			"(19, 'owneremail', '');") 
			or die("Could not insert records in table settings. Error: " . mysql_error());

		$siteName = str_replace('install.php','',f());		

		$fo = fopen("./config.php",'w+');
		fwrite($fo,"<?php
\$sitename = '$siteName';

function connect() {	
	mysql_connect('" . $server . "','" . $username . "','" . $password . "');
	mysql_select_db('" . $database . "');	
}
?>");

		fclose($fo);
		
		$message = '<p style="color:green; font-weight:bold;">' . 
			'Installation complete, please delete the installer.php file for security purposes.</p>';
		$complete = true;
		
	} catch(Exception $e) {
		$message = '<p style="color:red; font-weight:bold;">' . $e->getMessage() . '</p>';
	}
}

function f() {
	$pageURL = 'http';
	
	if(!empty($_SERVER['HTTPS'])) {
		if ($_SERVER["HTTPS"] == "on") {
			$pageURL .= "s";
		}
	}
	
	$pageURL .= "://";
	
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}

	return $pageURL;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Installation Process</title>
		<style type="text/css">
			*{
				font-family: Arial, Gadget, sans-serif; /* "Trebuchet MS",Tahoma,sans-serif;*/
			}
			h1 {
				text-align: center;
			}
			body{
				background-color:#cccccc;
			}
		</style>
	</head>
	<body>

	<div style="margin:auto; margin-top:20px;width:600px; min-height:300px; background-color:white; padding:30px;">
		<h1>CodeHave 2.2 Installation</h1>
		<p>You need to provide some basic MySQL informations to setup the script correctly.</p><br />
		
		<?php
			if(isset($message)){
				echo $message;
			}
		?>		

<?php if(empty($complete)) { ?>
		<form action="" method="post">		
			<table width="90%" cellpadding="0" cellspacing="0" border="0">
				<tr style="height: 30px;">
					<td width="50%">MySQL Username:</td>
					<td width="50%"><input type="text" name="mysql_username" value="" style="width:150px;" /></td>
				</tr>			
				<tr style="height: 30px;">
					<td>MySQL Password:</td>
					<td><input type="password" name="mysql_password" value="" style="width:150px;" /></td>
				</tr>
				<tr style="height: 30px;">
					<td>MySQL Database Name:</td>
					<td><input type="text" name="mysql_db" style="width:150px;" /></td>
				</tr>
				<tr style="height: 30px;">
					<td>MySQL Server:</td>
					<td><input type="text" name="mysql_server" value="" style="width:150px;" /></td>
				</tr>
			</table>
			<br />
			<input type="submit" value="submit" />
		</form>
<?php } else { ?>
		<br /><br />
        <table width="100%"><tr><td style="text-align:center;">
        	<a href="index.php">Homepage</a>
        </td><td style="text-align:center;">
			<a href="admin/index.php">Admin Area</a>
        </td></tr></table>
        
<?php } ?>
	</div>
	
	</body>
</html>
