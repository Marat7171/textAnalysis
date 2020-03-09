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
	wordFun($pdo, $text, $time);
	uploadedTextFun($pdo, $text, $time);
}

if (!($textFile['name']['0'] == "")) {
	fileRecord($timef, formatConversion($textFile['tmp_name']['0']));
	wordFun($pdo, formatConversion($textFile['tmp_name']['0']), $timef);
	uploadedTextFun($pdo, formatConversion($textFile['tmp_name']['0']), $timef);
}

header('Location: index.php');