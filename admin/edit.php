<?php
require_once('common.php');
if(isset($_GET['id'])){
	$post_id = trim($_GET['id']);
	$db = new Database();
	$post = $db->getPostById($post_id);
	if(isset($_POST['post_id'])){
		$data = array(
			'post_title'     => trim($_POST['post_title']),
			'post_content'   => trim($_POST['post_content']),
			'post_status'    => trim($_POST['post_status']),
		);
		if($data['post_title'] != '' && $data['post_content'] != '')
		{
			$db = new Database();
			$db->updatePost($_POST['post_id'], $data);
			header('location: index.php');
		}else{
			$error_message = 'Title and Content cannot be empty';
		}
	}
}else{
	header('location: index.php');
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
	<h2>Edit page</h2>
	<a href="index.php" class="button">Back</a>
	<form method="post" action="">
		<?php if(isset($error_message)) echo '<span class="error_message">'.$error_message.'</span>'; ?>
		<label>Post Title</label>
		<input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>" />
		<input type="text" name="post_title" value="<?php echo $post['post_title']; ?>" size="50" />
		<label>Post Content</label>
		<textarea name="post_content" cols="50" rows="15"><?php echo $post['post_content']; ?></textarea>
		<br /><br />
		<select name="post_status">
			<option value="<?php echo ENABLE ?>" <?php if($post['post_status'] == ENABLE) echo 'selected="selected"'; ?>>Enable</option>
			<option value="<?php echo DISABLE; ?>" <?php if($post['post_status'] == DISABLE) echo 'selected="selected"'; ?> >Disable</option>
		</select>
		<br /><br />
		<input type="submit" value="Save Post" class="button" />
	</form>
</div><!--end .container-->

</body>
</html>