<?php
session_start();

include('../config.php');
include('cryptor.php');
include('functions.php');

$drop = $_POST['drop'];
connect();

$code = ch_formatCodeForDatabase($_POST['code']);

$password = mysql_real_escape_string(htmlspecialchars(strip_tags($_POST['password'])));
$codetitle = htmlspecialchars($_POST['codetitle']);
$usecaptcha = ($_POST['captcha'] == 'on' ? 1 : 0);

$cryptor = new Cryptor();

$sqlInsert = "INSERT INTO codes (code, type, password, codetitle, captcha) VALUES ('" . $code . "', '" .
     $drop . "', '" . $cryptor->encrypt($password) . "', '" . $codetitle . "', '" . $usecaptcha . "')";

$affected_rows = mysql_query($sqlInsert);

$id = mysql_insert_id();
$result = mysql_query("SELECT * FROM codes WHERE id='".$id."'") or die(mysql_error());
$row = mysql_fetch_array($result);

//Full URL
//$link = $sitename . "show.php?id=" . $row['id'];

//Shortened URL
$link = $sitename . $row['id'];

include_once 'geshi.php';
$type = ch_gettype(ch_getcodetype($id), false);
$source = ch_formatCodeForDisplaying(ch_getcode($id));

$geshi = new GeSHi($source, $type);
$geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS);
$geshi->set_line_style('background: #fcfcfc;', 'background: #f0f0f0;');
$geshi->set_header_type(GESHI_HEADER_DIV);
$geshi->set_tab_width(5);
$geshi->enable_classes();
$geshi->set_overall_id('mycode');
?>

<style type="text/css"><?=$geshi->get_stylesheet()?></style>
<div class="top3"></div>
<center>
	<div class="textbox1">Share URL: <a href="<?=$link?>"><?=$link?></a></div>
</center>
<div class="bottom3"></div>
<br />

<div class='top'></div>
<center><div class='textbox2' id="snippet"><?=$geshi->parse_code()?></div></center>
<div class='bottom'></div>

