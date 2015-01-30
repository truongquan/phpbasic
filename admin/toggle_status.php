<?php
require_once('common.php');
$db = new Database();
if(isset($_GET['status'])){
	$current_status = mysqli_real_escape_string($db->conn, stripslashes(trim($_GET['status'])));
	$post_id = mysqli_real_escape_string($db->conn, stripslashes(trim($_GET['id'])));
	if(is_numeric($post_id))
		$db->toggleStatus($current_status, $post_id);
	
}
header('location: index.php');
?>