<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<a href="loading.php">загрузить текст</a>
	<?php 
	require_once 'connectdb.php';
	require_once 'myFunctions.php';

	foreach(homePageDatabaseHandler($pdo) as $a => $b): ?>
		<p>	
			<?php outputToTheMainScreen($b); ?>
			<form method="post" action="specificText.php">
				<button type="submit" name="id_db" value="<?php echo $b['id']; ?>">Детальный анализ</button>
			</form>
		</p>
	<?php endforeach; ?>	
</body>
</html>
