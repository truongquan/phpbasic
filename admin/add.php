<?php
require_once('common.php');
if (isset($_POST['post_title'])) {
	$db = new Database();
	$data = array(
		'post_title'     => trim($_POST['post_title']),
		'post_content'   => trim($_POST['post_content']),
		'post_status'    => trim($_POST['post_status']),
	);
	if($data['post_title'] != '' && $data['post_content'] != ''){
		$db->insertPost($data);
		header('location: index.php');
	}else{
		$error_message = 'Title and Content cannot be empty';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../css/style.css" />
	<title>List page</title>
</head>
<body>
<div class="container">
	<h1>Backend Page</h1>
	<a href="logout.php">Log out</a>
	<h2>Create page</h2>
	<a href="index.php" class="button">Back</a>
	<form method="post" action="">
		<?php if(isset($error_message)) echo '<span class="error_message">'.$error_message.'</span>'; ?>
		<label>Post Title</label>
		<input type="text" name="post_title" size="50" />
		<label>Post Content</label>
		<textarea name="post_content" cols="50" rows="15"></textarea>
		<br /><br />
		<select name="post_status">
			<option value="<?php echo ENABLE ?>">Enable</option>
			<option value="<?php echo DISABLE; ?>">Disable</option>
		</select>
		<br /><br />
		<input type="submit" value="Save Post" class="button" />
		<input type="reset" value="Reset<" class="button" />
	</form>
</div><!--end .container-->
<h3>Vim to edit file in terminal :)</h3>
</body>
</html>
