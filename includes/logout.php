<?php
session_start();
require('login.class.php');

$loginSys = new LoginSystem();
$loginSys->logout();

header("location: ../admin/login.php");
?>