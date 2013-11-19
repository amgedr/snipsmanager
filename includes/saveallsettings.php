<?php
session_start();
include('../config.php');
include('../includes/functions.php');
connect();

require('../includes/login.class.php');
$loginSys = new LoginSystem();

// if not logged in goto login form, otherwise we can view our page
if(!$loginSys->isLoggedIn()) {
	header("Location: login.php");
	exit;
}

ch_savesetting('title', $_POST['sitetitle']);
ch_savesetting('slogan', $_POST['slogan']);
ch_savesetting('logourl', $_POST['logourl']);
ch_savesetting('metadescription', $_POST['metadescription']);
ch_savesetting('metakeywords', $_POST['metakeywords']);
ch_savesetting('ownername', $_POST['ownername']);
ch_savesetting('owneremail', $_POST['owneremail']);

if(!empty($_POST['item1text']) && !empty($_POST['item1url'])) {
	ch_savesetting('topmenu1text', $_POST['item1text']);
	ch_savesetting('topmenu1url', $_POST['item1url']);
}
else {
	ch_savesetting('topmenu1text', '');
	ch_savesetting('topmenu1url', '');
}

if(!empty($_POST['item2text']) && !empty($_POST['item2url'])) {
	ch_savesetting('topmenu2text', $_POST['item2text']);
	ch_savesetting('topmenu2url', $_POST['item2url']);
}
else {
	ch_savesetting('topmenu2text', '');
	ch_savesetting('topmenu2url', '');
}

if(!empty($_POST['item3text']) && !empty($_POST['item3url'])) {
	ch_savesetting('topmenu3text', $_POST['item3text']);
	ch_savesetting('topmenu3url', $_POST['item3url']);
}
else {
	ch_savesetting('topmenu3text', '');
	ch_savesetting('topmenu3url', '');
}

if(!empty($_POST['item4text']) && !empty($_POST['item4url'])) {
	ch_savesetting('topmenu4text', $_POST['item4text']);
	ch_savesetting('topmenu4url', $_POST['item4url']);
}
else {
	ch_savesetting('topmenu4text', '');
	ch_savesetting('topmenu4url', '');
}

//ch_savesetting('iconset', $_POST['sbfolders']);

?>