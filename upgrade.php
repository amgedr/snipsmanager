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
		<h1>SnipsManager 2.3 Upgrade</h1>

		<?php
        if(isset($_GET['upgrade'])) {
			try {
				include('config.php');
				connect();

				//if table admins does not exist
				if(!mysql_num_rows(mysql_query("SHOW TABLES LIKE 'admins'"))) {
					//version 2.2
					//create table admin
					mysql_query("CREATE TABLE IF NOT EXISTS `admins` (`UserName` varchar(20) NOT NULL," .
						"`Password` varchar(32) NOT NULL, PRIMARY KEY (`UserName`)" .
						") ENGINE=MyISAM DEFAULT CHARSET=latin1;") or
						die("Could not create admin table. Error: " . mysql_error());

					//version 2.2
					//insert admin user in table admin with password admin
					mysql_query("INSERT INTO `admins` (`UserName`, `Password`) VALUES (" .
						"'admin', '21232f297a57a5a743894a0e4a801fc3');") or
						die("Could not insert records in table admin. Error: " . mysql_error());
				}

				//if table settings does not exist
				if(!mysql_num_rows(mysql_query("SHOW TABLES LIKE 'settings'"))) {
					//version 2.2
					//create table settings
					mysql_query("CREATE TABLE IF NOT EXISTS `settings` (" .
						"`settingid` bigint(20) unsigned NOT NULL AUTO_INCREMENT, `settingname` varchar(50) NOT NULL," .
						" `settingvalue` varchar(300) NOT NULL, UNIQUE KEY `settingid` (`settingid`)" .
						") ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24;") or
						die("Could not create setting table. Error: " . mysql_error());

					//version 2.2
					//insert default settings into the settings table
					mysql_query("INSERT INTO `settings` (`settingid`, `settingname`, `settingvalue`) VALUES " .
						"(1, 'version', '2.3'), " .
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
						"(19, 'owneremail', ''), " .
						"(20, 'urlwww', '0'), " .
						"(21, 'urlindex', '1'), " .
						"(22, 'urlshorten', '1'); ")
						or die("Could not insert records in table settings. Error: " . mysql_error());
				}

				//version 2.2
				//Alter table codes. Doesn't need to return an error if the SQL statement didn't execute
				//because the only error that could occure this far in the code is Column Already Exists.
				mysql_query("ALTER TABLE `codes` ADD COLUMN `codetitle` varchar(200) NOT NULL, " .
						"ADD COLUMN `submitdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ");

				//version 2.3
				//Alter table codes. Doesn't need to return an error if the SQL statement didn't execute
				//because the only error that could occure this far in the code is Column Already Exists.
				mysql_query("ALTER TABLE `codes` ADD `captcha` TINYINT NULL DEFAULT '0' " .
					"COMMENT 'Ask for CAPTCHA before display this snippet.' ");

				//version 2.3
				//Add URL redirection settings
				$result = mysql_query("SELECT * FROM `settings` WHERE `settingname` LIKE 'urlwww'");
				if(mysql_num_rows($result) == 0)
					mysql_query("INSERT INTO `settings` (`settingid`, `settingname`, `settingvalue`) " .
						"VALUES (NULL, 'urlwww', '0')");

				$result = mysql_query("SELECT * FROM `settings` WHERE `settingname` LIKE 'urlindex'");
				if(mysql_num_rows($result) == 0)
					mysql_query("INSERT INTO `settings` (`settingid`, `settingname`, `settingvalue`) " .
						"VALUES (NULL, 'urlindex', '0')");

				$result = mysql_query("SELECT * FROM `settings` WHERE `settingname` LIKE 'urlshorten'");
				if(mysql_num_rows($result) == 0)
					mysql_query("INSERT INTO `settings` (`settingid`, `settingname`, `settingvalue`) " .
						"VALUES (NULL, 'urlshorten', '0')");

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
                <center><input type="submit" value="Start Database Upgrade" /></center>
            </form>
        <?php } ?>

	</div>
    </body>
</html>