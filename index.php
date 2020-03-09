<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>

	<a href="launchDb.php">создать бд</a><br>
	<a href="loading.php">загрузить текст</a>
	<?php 
	require_once 'connectdb.php';
	$selectQuery = 'SELECT * FROM `uploaded_text` ORDER BY `id` DESC';
	$query = $pdo->query($selectQuery);
	while($row = $query->fetch(PDO::FETCH_OBJ)): ?>
		<p><?php echo $row->id . " / " . substr($row->content, 0, 30) . '...' . " / " . date('l jS \of F Y h:i:s A', $row->date) . " / " . $row->words_count; ?><form method="post" action="specificText.php"><button type="submit" name="id_db" value="<?php echo $row->id; ?>">Детальный анализ</button></form></p>
	<?php endwhile; ?>	
</body>
</html>