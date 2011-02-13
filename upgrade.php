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
 * Database upgrader from 1.x to 2.x
 *
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Installation Process</title>
		<style type="text/css">
			*{
				font-family: Arial, Gadget, sans-serif; 
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
	
	<div style="margin:auto; margin-top:20px;width:600px; min-height:200px; background-color:white; padding:30px;">
		<h1>SnipsManager 2.2 Upgrade</h1>

		<?php
        if(isset($_GET['upgrade'])) {
			try {
				include('config.php');
				connect();
				
				//create table admin
				mysql_query("CREATE TABLE IF NOT EXISTS `admins` (`UserName` varchar(20) NOT NULL," .
					"`Password` varchar(32) NOT NULL, PRIMARY KEY (`UserName`)" .
					") ENGINE=MyISAM DEFAULT CHARSET=latin1;") or 
					die("Could not create admin table. Error: " . mysql_error());		
			
				//insert admin user in table admin with password admin		
				mysql_query("INSERT INTO `admins` (`UserName`, `Password`) VALUES (" . 
					"'admin', '21232f297a57a5a743894a0e4a801fc3');") or 
					die("Could not insert records in table admin. Error: " . mysql_error());
		
				//alter table codes
				mysql_query("ALTER TABLE `codes` ADD COLUMN `codetitle` varchar(200) NOT NULL, " . 
					"ADD COLUMN `submitdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP;") or 
					die("Could not modify codes table. Error: " . mysql_error());
		
				//create table settings
				mysql_query("CREATE TABLE IF NOT EXISTS `settings` (" . 
					"`settingid` bigint(20) unsigned NOT NULL AUTO_INCREMENT, `settingname` varchar(50) NOT NULL," .
					" `settingvalue` varchar(300) NOT NULL, UNIQUE KEY `settingid` (`settingid`)" .
					") ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;") or 
					die("Could not create setting table. Error: " . mysql_error());
		
				//insert default settings into the settings table
				mysql_query("INSERT INTO `settings` (`settingid`, `settingname`, `settingvalue`) VALUES " .
					"(1, 'version', '2.2'), " .
					"(2, 'title', 'SnipsManager'), " .
					"(5, 'slogan', 'Share the code!'), " .
					"(6, 'metadescription', 'A code sharing website.'), " .
					"(17, 'iconset', '2'), " .
					"(7, 'metakeywords', 'code sharing, text sharing'), " .
					"(8, 'logourl', 'images/snipsmanager.png'), " .
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
		
				
				echo '<p style="color:green; font-weight:bold;">The database upgrade completed successfully.</p>';
			
			} catch (Exception $e) {
				echo '<p style="color:red; font-weight:bold;">' . $e->getMessage() . '</p>';
			}
		?>

		<br /><br />
        <table width="100%"><tr><td style="text-align:center;">
        	<a href="index.php">Homepage</a>
        </td><td style="text-align:center;">
			<a href="admin/index.php">Admin Area</a>
        </td></tr></table>
			        
        
        <?php } else {  ?>  
            <p>To upgrade the database from version 1.2 and 1.5 to 2.2 please click the button below.</p>
            <br />
            <br />

            
            <form method="get" action="" >     
            	<input type="hidden" id="upgrade" name="upgrade" value="start" />       	
                <center><input type="submit" value="Start Database Upgrade"  /></center>
            </form>
        <?php } ?>
        
	</div>
    </body>
</html>