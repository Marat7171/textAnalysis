<?php
$driver = 'mysql';
$host = 'localhost';
$dbname = 'textAnalysis';
$db_user = 'mysql';
$db_pass = 'mysql';
$charset = 'utf8';
$option = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

$base = "$driver:host=$host;dbname=$dbname;charset=$charset";
$pdo = new PDO ($base, $db_user, $db_pass, $option);
