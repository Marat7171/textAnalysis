<?php
$id_db = $_POST['id_db'];
require_once 'connectdb.php';

$selectQuery = "SELECT * FROM `uploaded_text` WHERE `id` = {$id_db}";
$row = $pdo->query($selectQuery)->fetch(PDO::FETCH_OBJ);
echo $row->content . ' / ' . date('l jS \of F Y h:i:s A', $row->date) . ' / ' . $row->words_count;
echo '<br>';
$selectQueryw = "SELECT * FROM `word` WHERE `text_id` = {$id_db}"; 
$roww = $pdo->query($selectQueryw)->fetchall(PDO::FETCH_ASSOC);
foreach ($roww as $a => $b) {
	echo "Слово: " . '"' .$b['word'] . '"' . " Количество вхождений: " . $b['count'] . "<br>"; 
}
