<?php
include_once('../config.php');
include_once('../includes/functions.php');
connect();

if (!empty($_GET['id'])) {
	$id = mysql_real_escape_string(htmlspecialchars(strip_tags($_GET['id'])));
} else {
	$id = 0;
}

echo html_entity_decode(ch_getcode($id), ENT_QUOTES);
?>