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
 * Displays the RSS feed of CodeHill.com. Uses rss_read.php.
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
}?>

	<div class='sub'>
	    <span>Logged in as <?php echo  $_SESSION['userName']; ?>&nbsp;&nbsp;
    	<a href="changepassword.php">Change Password</a>&nbsp;&nbsp;
    	<a href="../includes/logout.php">Logout</a></span>
    	News & Updates</div>

	<div class='content'>
		<div id='error'></div>

<div class='top'></div>
<center>
<div class='textbox2'>
<?php
	include('../includes/rss_read.php'); 
	
	$RSSread = new RSSread(true);
	$RSSread->rssFeed = "http://feeds2.feedburner.com/CodeHill"; //URL for the RSS feed
	$RSSread->numPosts = 5; //The number of posts to output. -1 use all posts [default:3]
	$RSSread->whichOne = "w"; //Which format to use: s = Sentences; w = Words; c = Chars; n = None (use all the post) [default:s]
	$RSSread->numSentences = 1;   //The number of Sentences to use [default:3]
	$RSSread->numWords = 25;      //The number of Words to use [default:40]
	$RSSread->numChars = 50;     //The number of Characters to use [default:200]
	$RSSread->stripLinks = false; //Whether to remove links from posts [default:false]
	$RSSread->postLinkTarget = ""; // The target to open the links in posts in, takes the same values as the target attribute in the <a> tag. If set to "" or "_self" the target attribute will be omitted [default:_blank] 
	$RSSread->outputFormat = "<h3>[title]</h3><p>[post][link][Read more][/link]</p>";
	$RSSread->joinOutputBy = "<br />"; //HTML code that is attached inbetween posts
	
	print $RSSread->RSSoutput();	
?>
</div>
<div class='bottom'></div>

<?php include("footer.php"); ?>