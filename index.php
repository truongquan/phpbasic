<?php 
require_once('class/database.php');
$db = new Database('test','localhost','root','quan1234');
$result = $db->query('select * from posts')
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/style.css" />
	<title>This is my testing PHP</title>
</head>
<body>
<div class="container">
<h1>Frontend Page</h1>
	<?php foreach($result as $item): ?>
		<div class="item">
			<h3><?php echo $item['post_title']; ?></h3>
			<p><?php echo $item['post_content']; ?></p>
		</div><!--end .item-->
	<?php endforeach; ?>
</div><!--end .container-->

</body>
</html>