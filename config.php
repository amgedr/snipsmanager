<?php
$sitename = 'http://localhost/codehave/';

function connect() {	
	mysql_connect('localhost','root','');
	mysql_select_db('codehave');	
}
?>