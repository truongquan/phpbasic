<?php
require_once('common.php');
if(isset($_GET['id'])){
	$db = new Database();
	$post_id = mysqli_real_escape_string($db->conn, stripslashes(trim($_GET['id'])));
	$db->delPost($post_id);
}
header('location: index.php') 
?>