<?php
require_once 'myFunctions.php';
require_once 'connectdb.php';
// Для создания уникального имени файла 
$time = time();
$timef = $time + 2;

$text = $_POST['text'];
$textFile = $_FILES['docs'];

if (!($text == "")) {
	fileRecord($time, $text);
	$sql = 'INSERT INTO word(text_id, word, count) VALUES (:text_id, :word, :count)';
	$params = $pdo->prepare($sql);
	foreach (analysis($text) as $a => $b) {
		if (!($a === 'Всего слов')) {
			$params->execute(['text_id' => $time, 'word' => $a, 'count' => $b]);
		}
	}
	$sqlt = 'INSERT INTO uploaded_text(id, content, date, words_count) VALUES (:id, :content, :date, :words_count)';
	$paramst = $pdo->prepare($sqlt);
	$paramst->execute(['id' => $time, 'content' => $text, 'date' => $time, 'words_count' => array_pop(analysis($text))]);

}

if (!($textFile['name']['0'] == "")) {
	fileRecord($timef, formatConversion($textFile['tmp_name']['0']));
	$sql = 'INSERT INTO word(text_id, word, count) VALUES (:text_id, :word, :count)';
	$params = $pdo->prepare($sql);
	foreach (analysis(formatConversion($textFile['tmp_name']['0'])) as $a => $b) {
		if (!($a === 'Всего слов')) {
			$params->execute(['text_id' => $timef, 'word' => $a, 'count' => $b]);
		}
	}
	$sqlt = 'INSERT INTO uploaded_text(id, content, date, words_count) VALUES (:id, :content, :date, :words_count)';
	$paramst = $pdo->prepare($sqlt);
	$paramst->execute(['id' => $timef, 'content' => formatConversion($textFile['tmp_name']['0']), 'date' => $time, 'words_count' => array_pop(analysis(formatConversion($textFile['tmp_name']['0'])))]);
}
header('Location: index.php');