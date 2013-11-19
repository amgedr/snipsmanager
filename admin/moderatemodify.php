<?php
include('../config.php');
include('../includes/functions.php');
connect();

if (!empty($_POST['id'])) {
	$id = $_POST['id'];
	$codetitle = htmlspecialchars($_POST['codetitle']);
	$code = ch_formatCodeForDatabase($_POST['code']);

	mysql_query("UPDATE `codes` SET `code`='$code', `codetitle`='$codetitle' WHERE `id`=$id");
}

?>