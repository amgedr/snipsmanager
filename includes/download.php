<?php
//download a text file containing the string passed and using the file name and extension passed

header("Content-type: application/octet-stream");

session_start();
include('../config.php');
include('functions.php');
connect();

if($_POST['passwd'] != '')
	$result = mysql_query("SELECT * FROM codes WHERE id = '" . $_POST['id'] . "' AND password = '" . $_POST['passwd'] . "'");
else
	$result = mysql_query("SELECT * FROM codes WHERE id = '" . $_POST['id'] . "'");

$row = mysql_fetch_array($result);

if(mysql_num_rows($result)) {
	$extension = ch_getTypeExtension($row['type']);
}

header("Content-Disposition: attachment; filename=\"sourcefile" . $extension . "\"");

if(mysql_num_rows($result)) {
	echo html_entity_decode($row['code'], ENT_QUOTES);
}
?>