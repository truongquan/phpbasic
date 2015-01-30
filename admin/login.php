<?php
session_start();
require_once('../class/auth.php');
$auth = new Auth();
if ($auth->check_login()) {
	header('location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../css/style.css" />
	<title>Login page</title>
</head>
<body>
<div class="container">
	<form method="post" action="login.php">
		<h2>Login Form</h2>
		<span class="error_message"><?php echo $auth->error_message; ?></span>
		<label>Username</label>
		<input type="text" name="username" />
		<label>Password</label>
		<input type="password" name="password" />
		<br /><br />
		<input class="button" type="submit" value="login" name="submit" />
	</form>
</div><!--end .container-->

</body>
</html>