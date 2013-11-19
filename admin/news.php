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
</center>
<?php include("footer.php"); ?>