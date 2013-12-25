<?php
$sitename = 'http://localhost/snipsmanager/';

function connect() {	
	mysql_connect('localhost','root','');
	mysql_select_db('snipsmanager');	
}
?>