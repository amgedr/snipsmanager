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
 *
 * Header of all pages in the admin area.
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link rel="shortcut icon" href="../favicon.ico" />

<meta name="robots" content="noindex" />
<meta name="robots" content="nofollow" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="css/reset.css" />
<link rel="stylesheet" href="css/style.css" /> 
<link rel="stylesheet" href="css/buttons.css" />

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-impromptu.3.1.min.js"></script>
<script type="text/javascript" src="js/jquery.idTabs.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<style>
	.tablerow {
		padding-left:3px;
		border:1px solid #999;
		vertical-align:middle;
	}
	.tabletitle {
		background-color:#D9EAF3;
		padding-left:3px;
		border:1px solid #999;
		vertical-align:middle;
	}
	.tablenav {
		text-align:center;
		vertical-align:middle;
		font-weight:bold;
	}
	.checkboxes { }
	
	/*-------------impromptu---------- */
	.jqifade{ position: absolute; background-color: #aaaaaa; }
	div.jqi{ width: 700px; height: 450px; font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; position: absolute; background-color:#eee ; font-size: 11px; text-align: left; border: solid 1px #eeeeee; -moz-border-radius: 10px; -webkit-border-radius: 10px; padding: 7px; }
	div.jqi .jqicontainer{ font-weight: bold; }
	div.jqi .jqiclose{ position: absolute; top: 4px; right: -2px; width: 18px; cursor: default; color: #bbbbbb; font-weight: bold; }
	div.jqi .jqimessage{ padding: 5px; line-height: 20px; color: #444444; }
	div.jqi .jqibuttons{ text-align: right; padding: 5px 0 5px 0; }
	div.jqi button{ padding: 3px 10px; margin: 0 10px; background-color: #2F6073; border: solid 1px #f4f4f4; color: #ffffff; font-weight: bold; font-size: 12px; }
	div.jqi button:hover{ background-color: #728A8C; }
	div.jqi button.jqidefaultbutton{ background-color: #BF5E26; }
	.jqiwarning .jqi .jqibuttons{ background-color: #BF5E26; }
	
	div.jqi #codetitle { font-size:16px; width:99%; border:1px solid #999; margin-bottom: 15px;}
	div.jqi #codeview { height:310px; border:1px solid #999; padding:5px; overflow:auto; background-color:#ffffff; width:98%; }
	
	div.jqi .jqimessage .field{ padding: 5px 0; }
	div.jqi .jqimessage .field label{ display: block; clear: left; float: left; width: 100px; }
	div.jqi .jqimessage .field input{ width: 150px; border: solid 1px #777777; }
	div.jqi .jqimessage .field input.error{ width: 150px; border: solid 1px #ff0000; }
	/*-------------------------------- */

</style>

<meta name="generator" content="SnipsManager <?php echo ch_getsetting('version'); ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SnipsManager Admin</title>
</head>
<body>

<div class='header'>
	<?php  
		//hide the menu if the page is login.php or forgotpassword.php
		$filename = basename($_SERVER['PHP_SELF']);		
		if($filename != "login.php" & $filename != "forgotpassword.php") {
	?>
	<ul>
    	<li><a href="index.php">Home</a></li>
		<li><a href="settings.php">Settings</a></li>
        <li><a href="moderate.php">Moderate</a></li>
        <li><a href="news.php">News</a></li>
	</ul>
    <?php } ?>
	<a href="../index.php"><img src="images/snipsmanager.png" title="Home" alt="SnipsManager"/></a>
</div>