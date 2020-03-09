<?php
$servername = "localhost";
$username = "mysql";
$password = "mysql";

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE textAnalysis";
    $conn->exec($sql);
    // echo "Database created successfully<br>";
}
catch(PDOException $e)
{
    // echo $sql . "<br>" . $e->getMessage();
}

$conn = null;

require_once 'connectdb.php';

$pdo->query('CREATE TABLE IF NOT EXISTS `textanalysis`.`uploaded_text` ( `id` INT(255) NOT NULL AUTO_INCREMENT , `content` TEXT NOT NULL , `date` VARCHAR(255) NOT NULL , `words_count` VARCHAR(255) NOT NULL , UNIQUE (`id`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci');

$pdo->query('CREATE TABLE IF NOT EXISTS`auction`.`users` ( `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `login` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `password` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `rtime` INT(20) NOT NULL , INDEX (`id`)) ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_general_ci');

$pdo->query('CREATE TABLE IF NOT EXISTS`textanalysis`.`word` ( `id` INT(255) NOT NULL AUTO_INCREMENT , `text_id` INT(255) NOT NULL , `word` TEXT NOT NULL , `count` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci');

$pdo->query('ALTER TABLE `word` ADD INDEX( `text_id`)');

$pdo->query('ALTER TABLE `uploaded_text` ADD CONSTRAINT `uploaded_text_ibfk_1` FOREIGN KEY (`id`) REFERENCES `word`(`text_id`) ON DELETE RESTRICT ON UPDATE CASCADE;');
