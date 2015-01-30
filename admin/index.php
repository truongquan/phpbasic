<?php
//echo "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
require_once('common.php');
$db = new Database();
$result = $db->getPosts();
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
	<h2>List page</h2>
	<a href="add.php" class="button">Create Post</a>
	<table cellpadding="4" cellspacing="0" id="content">
		<thead>
			<tr>
				<th>Title</th>
				<th>Status</th>
				<th colspan="2">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($result as $item): ?>
			<tr>
				<td><?php echo $item['post_title'] ?></td>
				<td>
					<?php
					if($item['post_status'] == ENABLE){
						echo '<a class="enable" title="Enable" href="toggle_status.php?id='.$item['post_id'].'&status='.ENABLE.'"></a>';
					}else{
						echo '<a class="disable" title="Disable" href="toggle_status.php?id='.$item['post_id'].'&status='.DISABLE.'"></a>';
					}
					?>
				</td>
				<td><a class="edit" title="Edit" href="edit.php?id=<?php echo $item['post_id'] ?>"></a></td>
				<td><a class="delete" title="Delete" href="delete.php?id=<?php echo $item['post_id'] ?>" onclick="return confirm('Are you sure you want to delete this post?')"></a></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div><!--end .container-->

</body>
</html>