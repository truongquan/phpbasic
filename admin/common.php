<?php
session_start();
if(!isset($_SESSION['login_userid'])){
	header('location: login.php');
}
require_once('../class/database.php');
require_once('../constant.php'); 
?>